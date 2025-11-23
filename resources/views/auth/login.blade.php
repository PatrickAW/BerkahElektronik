<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Berkah Elektronik - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #fff;
      font-family: Arial, sans-serif;
    }

    .navbar-brand {
      font-weight: 800;
      color: #2948ff !important;
      text-transform: uppercase;
      line-height: 1.1;
    }

    .login-section {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 75vh;
      gap: 80px;
      flex-wrap: wrap;
      padding-top: 60px;
    }

    .login-text {
      flex: 1;
      text-align: left;
      font-size: 2rem;
      font-weight: 700;
      max-width: 400px;
      color: #000;
      transform: translateY(-20px);
    }

    .login-form {
      flex: 1;
      max-width: 420px;
      transform: translateY(-20px);
    }

    .form-label {
      font-size: 14px;
      color: #333;
    }

    .form-text {
      color: #6c757d;
      font-size: 12px;
      margin-top: 2px;
    }

    input::placeholder {
      color: #b0b0b0;
      font-size: 14px;
    }

    .btn-login {
      background-color: #2948ff;
      color: #fff;
      font-weight: 600;
      border-radius: 50px;
      height: 48px;
    }

    .btn-login:hover {
      background-color: #1934d4;
    }

    .btn-register {
      border-radius: 50px;
      border: 1.5px solid #000;
      color: #000;
      font-weight: 600;
      height: 48px;
      background: #fff;
    }

    .btn-register:hover {
      background-color: #f8f8f8;
    }

    /* PERBAIKAN: Search bar memanjang */
    .navbar-container {
      display: flex;
      align-items: center;
      width: 100%;
      justify-content: space-between;
    }

    .navbar-left-section {
      display: flex;
      align-items: center;
      gap: 40px;
    }

    .category-text {
      font-weight: bold;
      color: #000;
      font-size: 16px;
    }

    .navbar-center-section {
      display: flex;
      justify-content: center;
      flex: 1;
      margin: 0 40px;
    }

    .search-box {
      width: 100%;
      max-width: 600px;
    }

    .navbar-right-section {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    @media (max-width: 992px) {
      .login-section {
        flex-direction: column;
        text-align: center;
        gap: 40px;
        padding-top: 40px;
      }

      .login-text {
        text-align: center;
        font-size: 1.8rem;
        transform: none;
      }

      .login-form {
        width: 100%;
        max-width: 360px;
        transform: none;
      }

      .navbar-container {
        flex-direction: column;
        gap: 15px;
      }

      .navbar-left-section {
        width: 100%;
        justify-content: space-between;
      }

      .navbar-center-section {
        width: 100%;
        order: 3;
        margin: 0;
      }

      .navbar-right-section {
        width: 100%;
        justify-content: center;
      }

      .search-box {
        width: 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- Header dengan search bar memanjang -->
  <nav class="navbar navbar-light bg-white border-bottom shadow-sm px-3">
    <div class="container-fluid">
      <div class="navbar-container">
        <!-- Bagian kiri: Logo + Kategori -->
        <div class="navbar-left-section">
          <a class="navbar-brand" href="#">
            TOKO BERKAH<br>ELEKTRONIK
          </a>
          <span class="category-text">Kategori</span>
        </div>

        <!-- Bagian tengah: Search bar memanjang -->
        <div class="navbar-center-section">
          <input type="text" class="form-control form-control-sm search-box" placeholder="Cari Elektronik">
        </div>

        <!-- Bagian kanan: Icons -->
        <div class="navbar-right-section">
          <i class="bi bi-cart3" style="font-size: 1.2rem;"></i>
          <i class="bi bi-person" style="font-size: 1.2rem;"></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- Login Section -->
  <section class="login-section container mt-5 mb-5">
    <div class="login-text">
      <p>Silahkan masuk<br>ke akun anda</p>
    </div>

    <div class="login-form">
      {{-- Form login --}}
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        
        {{-- Email / HP --}}
        <div class="mb-3">
          <label class="form-label">Alamat email atau nomor handphone yang terverifikasi <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="email" placeholder="contoh@email.com atau 08123456789" required value="{{ old('email') }}">
          <div class="form-text">Masukkan email atau no handphone</div>
          @error('email')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
          <label class="form-label">Kata Sandi <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="password" class="form-control" name="password" placeholder="Kata sandi" required>
            <span class="input-group-text bg-white border-start-0"><i class="bi bi-eye"></i></span>
          </div>
          <div class="form-text"><a href="{{ route('reset.password') }}" class="text-decoration-none text-secondary">Lupa kata sandi?</a></div>
          @error('password')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        {{-- Tombol login --}}
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-login">Masuk</button>
        </div>

        {{-- Tombol daftar --}}
        <div class="d-grid">
          <a href="{{ route('register') }}" class="btn btn-register text-decoration-none text-center">Daftar sekarang?</a>
        </div>
      </form>
    </div>
  </section>

</body>
</html>