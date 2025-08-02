<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Penjualan EssyCoff</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .period { font-size: 14px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Laporan Penjualan EssyCoff</div>
        <div class="period">Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Order</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Items</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>#{{ $order->order_number }}</td>
                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    @foreach ($order->items as $item)
                        {{ $item->product->name }} ({{ $item->quantity }})<br>
                    @endforeach
                </td>
                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Transaksi: {{ number_format($totalOrders) }}</p>
        <p>Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
    </div>
</body>
</html>