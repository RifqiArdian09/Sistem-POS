@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
            <p class="text-gray-500">{{ now()->format('l, d F Y') }}</p>
        </div>
        <a href="{{ route('orders.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Transaksi Baru
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded border">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded">
                    <i class="fas fa-money-bill text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Penjualan Hari Ini</p>
                    <p class="text-xl font-semibold">Rp {{ number_format($total_sales_today, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded border">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded">
                    <i class="fas fa-coffee text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-xl font-semibold">{{ $total_products }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded border">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded">
                    <i class="fas fa-shopping-cart text-purple-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Pesanan Hari Ini</p>
                    <p class="text-xl font-semibold">{{ $today_orders_count }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded border">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Pesanan Pending</p>
                    <div class="flex items-center">
                        <p class="text-xl font-semibold">{{ $pending_orders_count }}</p>
                        <a href="{{ route('orders.pending') }}" class="ml-2 text-sm text-blue-600 hover:underline">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 bg-white rounded border">
            <div class="p-4 border-b">
                <h2 class="font-semibold text-gray-800">Transaksi Terakhir</h2>
            </div>
            <div class="divide-y">
                @forelse ($recent_orders as $order)
                <a href="{{ route('orders.show', $order->id) }}" class="block p-4 hover:bg-gray-50">
                    <div class="flex justify-between">
                        <div>
                            <p class="font-medium text-blue-600">#{{ $order->id }} - {{ $order->customer_name }}</p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ strtoupper($order->status) }}
                            </span>
                            <p class="font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-6 text-center text-gray-500">
                    Belum ada transaksi
                </div>
                @endforelse
            </div>
            <div class="p-4 bg-gray-50 text-right">
                <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline">Lihat semua </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="space-y-4">
            <!-- New Order -->
            <div class="bg-white p-6 rounded border">
                <h3 class="font-semibold mb-3">Buat Pesanan</h3>
                <p class="text-sm text-gray-600 mb-4">Mulai transaksi baru</p>
                <a href="{{ route('orders.create') }}" class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Transaksi Baru
                </a>
            </div>

            <!-- Product Management -->
            <div class="bg-white p-6 rounded border">
                <h3 class="font-semibold mb-3">Kelola Produk</h3>
                <div class="space-y-2">
                    <a href="{{ route('products.create') }}" class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        <i class="fas fa-plus mr-2"></i>Tambah Produk
                    </a>
                    <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        <i class="fas fa-list mr-2"></i>Daftar Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection