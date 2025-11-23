<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Berkah Elektronik - Reset Password</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .reset-section {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 75vh;
      gap: 80px;
      flex-wrap: wrap;
      padding-top: 60px;
    }

    .reset-text {
      flex: 1;
      text-align: left;
      font-size: 2rem;
      font-weight: 700;
      max-width: 400px;
      color: #000;
      transform: translateY(-20px);
    }

    .reset-form {
      flex: 1;
      max-width: 420px;
      transform: translateY(-20px);
    }

    .form-label {
      font-size: 14px;
      color: #333;
    }

    input::placeholder {
      color: #b0b0b0;
      font-size: 14px;
    }

    .btn-reset {
      background-color: #2948ff;
      color: #fff;
      font-weight: 600;
      border-radius: 50px;
      height: 48px;
    }

    .btn-reset:hover {
      background-color: #1934d4;
    }

    /* PERBAIKAN: Search bar memanjang sama seperti di halaman lain */
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
      .reset-section {
        flex-direction: column;
        text-align: center;
        gap: 40px;
        padding-top: 40px;
      }

      .reset-text {
        text-align: center;
        font-size: 1.8rem;
        transform: none;
      }

      .reset-form {
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

  <!-- NAVBAR dengan search bar memanjang -->
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

  <!-- RESET PASSWORD SECTION -->
  <section class="reset-section container mt-5 mb-5">

    <div class="reset-text">
      <p>Lupa kata sandi?</p>
    </div>

    <div class="reset-form">
      @if(session('error'))
        <p class="text-danger">{{ session('error') }}</p>
      @endif

      @if(session('success'))
        <p class="text-success">{{ session('success') }}</p>
      @endif

      <form method="POST" action="{{ url('/reset-password') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
          <label class="form-label">Email terdaftar <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" required placeholder="email@example.com">
        </div>

        {{-- Password baru --}}
        <div class="mb-3">
          <label class="form-label">Password Baru <span class="text-danger">*</span></label>
          <input type="password" name="password" class="form-control" required placeholder="Password baru">
        </div>

        {{-- Konfirmasi --}}
        <div class="mb-3">
          <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
          <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
        </div>

        {{-- Tombol --}}
        <div class="d-grid">
          <button type="submit" class="btn btn-reset">Reset Password</button>
        </div>

      </form>
    </div>

  </section>

</body>
</html>