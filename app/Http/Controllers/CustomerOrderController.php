<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_available', true)
            ->latest()
            ->get();
            
        $categories = Category::all();
        
        return view('customer.order', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($request) {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'status' => 'pending',
                'total_amount' => 0,
                'notes' => $request->notes,
            ]);

            $totalAmount = 0;

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                $subtotal = $product->price * $item['quantity'];

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $totalAmount += $subtotal;
            }

            $order->update(['total_amount' => $totalAmount]);
        });

        return redirect()->route('customer.order.success');
    }

    public function success()
    {
        return view('customer.success');
    }
}