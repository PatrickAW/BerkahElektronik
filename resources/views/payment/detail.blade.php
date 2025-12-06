<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi - Berkah Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Detail Transaksi</h2>
        
        <div class="card">
            <div class="card-body">
                <h5>Invoice: {{ $transaction->invoice_no }}</h5>
                <p>Tanggal: {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                <p>Status: {{ $transaction->payment_status }}</p>
                <p>Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                
                <h5>Item Pembelian:</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->items as $item)
                        <tr>
                            <td>{{ $item->product->judul }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <a href="{{ route('payment.history') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</body>
</html>