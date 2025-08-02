<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Order::with(['items.product'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->where('status', 'completed')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Jumlah Transaksi',
            'Total Penjualan',
            'Produk Terjual'
        ];
    }

    public function map($group): array
    {
        $date = $group->first()->created_at->format('Y-m-d');
        $totalSales = $group->sum('total_amount');
        $totalOrders = $group->count();
        $totalItems = $group->pluck('items')->flatten()->sum('quantity');

        return [
            $date,
            $totalOrders,
            $totalSales,
            $totalItems
        ];
    }
}