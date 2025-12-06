<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Berkah Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Checkout</h2>
        
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label>Alamat Pengiriman</label>
                <textarea name="shipping_address" class="form-control" required></textarea>
            </div>
            
            <div class="mb-3">
                <label>Metode Pembayaran</label>
                <select name="payment_method" class="form-control" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer Bank</option>
                </select>
            </div>
            
            <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
            
            <button type="submit" class="btn btn-success">Bayar Sekarang</button>
        </form>
    </div>
</body>
</html>