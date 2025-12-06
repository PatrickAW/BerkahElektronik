<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi - Berkah Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Riwayat Transaksi</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->invoice_no }}</td>
                    <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                    <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $transaction->payment_status }}</td>
                    <td>
                        <a href="{{ route('payment.detail', $transaction->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>