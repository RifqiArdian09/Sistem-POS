@extends('layouts.app')

@section('content')
<div class="px-6 py-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Hasil Laporan</h2>
        <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Periode</p>
                    <p class="text-lg font-semibold">{{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                    <p class="text-lg font-semibold">{{ number_format($totalOrders) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                    <p class="text-lg font-semibold">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grouped Report -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                @switch($reportType)
                    @case('daily') Laporan Harian @break
                    @case('weekly') Laporan Mingguan @break
                    @case('monthly') Laporan Bulanan @break
                    @case('yearly') Laporan Tahunan @break
                @endswitch
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            @switch($reportType)
                                @case('daily') Tanggal @break
                                @case('weekly') Minggu @break
                                @case('monthly') Bulan @break
                                @case('yearly') Tahun @break
                            @endswitch
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Transaksi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $period => $group)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            @if($reportType === 'daily')
                                {{ Carbon::parse($period)->format('d M Y') }}
                            @elseif($reportType === 'weekly')
                                Minggu ke-{{ explode('-', $period)[1] }} ({{ Carbon::parse($group->first()->created_at)->startOfWeek()->format('d M') }} - {{ Carbon::parse($group->first()->created_at)->endOfWeek()->format('d M Y') }})
                            @elseif($reportType === 'monthly')
                                {{ Carbon::parse($period . '-01')->format('M Y') }}
                            @else
                                {{ $period }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $group->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($group->sum('total_amount'), 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection