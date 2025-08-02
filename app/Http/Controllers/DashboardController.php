<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        return view('dashboard.index', [
            'total_sales_today' => Order::whereDate('created_at', $today)
                ->where('status', 'completed')
                ->sum('total_amount'),
            'total_products' => Product::count(),
            'today_orders_count' => Order::whereDate('created_at', $today)->count(),
            'pending_orders_count' => Order::where('status', 'pending')->count(),
            'recent_orders' => Order::with(['items.product', 'user'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}