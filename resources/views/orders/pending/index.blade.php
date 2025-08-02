@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Pesanan Pending</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('orders.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> Buat Pesanan
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No. Pesanan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pelanggan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pendingOrders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:underline">
                                        #{{ $order->id }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                    @if($order->notes)
                                        <div class="text-xs text-gray-500 mt-1">{{ $order->notes }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded text-sm">
                                                <i class="fas fa-check mr-1"></i> Selesaikan
                                            </button>
                                        </form>
                                        <form action="{{ route('orders.update-status', $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                                <i class="fas fa-times mr-1"></i> Batalkan
                                            </button>
                                        </form>
                                        <a href="{{ route('orders.receipt', $order->id) }}" target="_blank" class="text-white bg-gray-600 hover:bg-gray-700 px-3 py-1 rounded text-sm">
                                            <i class="fas fa-print mr-1"></i> Cetak
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada pesanan pending
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pendingOrders->hasPages())
                <div class="mt-4">
                    {{ $pendingOrders->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection