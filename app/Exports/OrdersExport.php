<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
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
        return Order::with(['items.product', 'user'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->where('status', 'completed')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Pesanan',
            'Tanggal',
            'Nama Pelanggan',
            'Kasir',
            'Produk',
            'Jumlah',
            'Harga Satuan',
            'Subtotal',
            'Total Pesanan',
            'Status'
        ];
    }

    public function map($order): array
    {
        $rows = [];
        
        foreach ($order->items as $item) {
            $rows[] = [
                $order->id,
                $order->created_at->format('Y-m-d H:i'),
                $order->customer_name,
                $order->user ? $order->user->name : '-',
                $item->product->name,
                $item->quantity,
                $item->price,
                $item->subtotal,
                $order->total_amount,
                $order->status
            ];
        }

        return $rows;
    }
}