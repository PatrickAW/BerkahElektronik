<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - Berkah Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Keranjang Belanja</h2>
        
        @if($cartItems->isEmpty())
            <p>Keranjang kosong</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->judul }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="text-end">
                <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                <a href="{{ route('payment.checkout') }}" class="btn btn-primary">Checkout</a>
            </div>
        @endif
    </div>
</body>
</html>