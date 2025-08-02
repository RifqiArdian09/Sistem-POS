<!DOCTYPE html>
<html>
<head>
    <title>Struk #{{ $order->id }}</title>
    <style>
        @page {
            size: 58mm auto;
            margin: 0;
        }

        body {
            width: 58mm;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header { text-align: center; margin-bottom: 10px; }
        .title { font-weight: bold; font-size: 14px; }
        .address { font-size: 10px; margin-bottom: 2px; }
        .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 2px 0; font-size: 11px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 8px; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">ESSY COFFEE SHOP</div>
        <div class="address">Jl. Contoh No. 123</div>
        <div class="address">Kota Contoh</div>
        <div>Telp: 0812-3456-7890</div>
    </div>

    <div class="divider"></div>

    <table style="width: 100%;">
        <tr>
            <td>No. Transaksi</td>
            <td class="text-right">#{{ $order->id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-right">{{ $order->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td class="text-right">{{ $order->customer_name }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-right">{{ $order->user->name ?? '-' }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subt.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td class="text-right"><strong>{{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="divider"></div>

    @if($order->notes)
    <div style="font-size: 10px;">
        <strong>Catatan:</strong> {{ $order->notes }}
    </div>
    @endif

    <div class="footer">
        Terima kasih telah berkunjung<br>
        Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
