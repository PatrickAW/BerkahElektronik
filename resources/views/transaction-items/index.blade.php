<!DOCTYPE html>
<html>
<head>
    <title>Item Transaksi - Berkah Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Daftar Item Transaksi</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactionItems as $item)
                <tr>
                    <td>{{ $item->transaction->invoice_no }}</td>
                    <td>{{ $item->product->judul }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>