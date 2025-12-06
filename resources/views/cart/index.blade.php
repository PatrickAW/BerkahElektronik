<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - Toko Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-bolt"></i> TOKO ELEKTRONIK
            </a>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-light me-2">
                    <i class="fas fa-store"></i> Produk
                </a>
                <a href="{{ route('cart.index') }}" class="btn btn-light">
                    <i class="fas fa-shopping-cart"></i> Keranjang
                    @php $cartCount = \App\Models\Cart::count(); @endphp
                    @if($cartCount > 0)
                        <span class="badge bg-danger">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @php $carts = \App\Models\Cart::with('product')->get(); @endphp
        
        @if($carts->count() > 0)
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carts as $cart)
                        @if($cart->product)
                            @php
                                $subtotal = $cart->product->harga_akhir * $cart->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $cart->product->judul }}</strong><br>
                                    <small>{{ $cart->product->brand }}</small>
                                </td>
                                <td>Rp {{ number_format($cart->product->harga_akhir, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-flex">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" 
                                               min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-sync"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr class="table-success">
                        <td colspan="4" class="text-end"><strong>TOTAL</strong></td>
                        <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Lanjut Belanja
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Kosongkan keranjang?')">
                            <i class="fas fa-trash"></i> Kosongkan
                        </button>
                    </form>
                </div>
                <a href="#" class="btn btn-success btn-lg">
                    <i class="fas fa-credit-card"></i> Checkout
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4>Keranjang kosong</h4>
                <p>Belum ada produk di keranjang</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="fas fa-store"></i> Belanja Sekarang
                </a>
            </div>
        @endif
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>