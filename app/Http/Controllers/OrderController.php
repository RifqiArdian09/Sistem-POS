<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product', 'user'])
            ->where('status', '!=', 'pending') // Exclude pending orders from main list
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function pendingOrders()
{
    $pendingOrders = Order::with(['items.product', 'user'])
        ->where('status', 'pending')
        ->latest()
        ->paginate(10);

    return view('orders.pending.index', compact('pendingOrders'));
}


    public function create()
    {
        $products = Product::where('is_available', true)->get();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required|json',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,completed'
        ]);

        $items = json_decode($validated['items'], true);

        if (!is_array($items)) {
            return back()->with('error', 'Format items tidak valid')->withInput();
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'status' => $validated['status'],
                'total_amount' => 0,
                'user_id' => auth()->id(),
                'notes' => $validated['notes'] ?? null
            ]);

            $totalAmount = 0;

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                if (!$product) {
                    throw new \Exception("Product dengan ID {$item['product_id']} tidak ditemukan");
                }

                $subtotal = $product->price * $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $totalAmount += $subtotal;
            }

            $order->update(['total_amount' => $totalAmount]);
            DB::commit();

            $redirectRoute = $order->status === 'pending' ? 'orders.pending.index' : 'orders.index';

            return redirect()->route($redirectRoute)
                ->with('success', 'Transaksi berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create order: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', Rule::in(['confirmed', 'completed', 'cancelled'])],
        ]);

        $order->update([
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);

        $statusMessages = [
            'confirmed' => 'Pesanan berhasil dikonfirmasi',
            'completed' => 'Pesanan berhasil diselesaikan',
            'cancelled' => 'Pesanan berhasil dibatalkan'
        ];

        return back()->with('success', $statusMessages[$request->status]);
    }

    public function printReceipt(Order $order)
    {
        $order->load('items.product');
        return view('orders.receipt', compact('order'));
    }

    public function destroy(Order $order)
    {
        try {
            DB::beginTransaction();

            $order->items()->delete();
            $order->delete();

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete order: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}