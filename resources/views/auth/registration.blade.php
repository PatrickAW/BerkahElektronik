<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Berkah Elektronik - Registrasi</title>

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

    .register-section {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 75vh;
      gap: 80px;
      flex-wrap: wrap;
      padding-top: 60px;
    }

    .register-text {
      flex: 1;
      text-align: left;
      font-size: 2rem;
      font-weight: 700;
      max-width: 400px;
      color: #000;
      transform: translateY(-20px);
    }

    .register-form {
      flex: 1;
      max-width: 420px;
      transform: translateY(-20px);
    }

    input::placeholder {
      color: #b0b0b0;
      font-size: 14px;
    }

    .btn-register {
      background-color: #2948ff;
      color: #fff;
      font-weight: 600;
      border-radius: 50px;
      height: 48px;
    }

    .btn-register:hover {
      background-color: #1934d4;
    }

    .btn-register:disabled {
      background-color: #6c757d;
      cursor: not-allowed;
    }

    .password-error {
      color: #dc3545;
      font-size: 12px;
      margin-top: 5px;
      display: none;
    }

    /* PERBAIKAN: Search bar memanjang sama seperti di login */
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
      .register-section {
        flex-direction: column;
        text-align: center;
        gap: 40px;
        padding-top: 40px;
      }

      .register-text {
        text-align: center;
        font-size: 1.8rem;
        transform: none;
      }

      .register-form {
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
          <a class="navbar-brand" href="{{ route('login') }}">
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

  <!-- REGISTER SECTION -->
  <section class="register-section container mt-5 mb-5">

    <div class="register-text">
      <p>Daftarkan akun<br>baru Anda</p>
    </div>

    <div class="register-form">

      <form method="POST" action="{{ route('register.post') }}" id="registerForm">
        @csrf

        <!-- Nama -->
        <div class="mb-3">
          <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" placeholder="Nama lengkap" required value="{{ old('name') }}">
          @error('name')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" placeholder="Email aktif" required value="{{ old('email') }}">
          @error('email')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="form-label">Kata Sandi <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Kata sandi" required>
          @error('password')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi" required>
          <div class="password-error" id="passwordError">Password dan konfirmasi password tidak sama</div>
        </div>

        <!-- Tombol -->
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-register" id="submitButton">Daftar Sekarang</button>
        </div>

        <div class="text-center">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Masuk</a>
        </div>

      </form>

    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('password_confirmation');
      const passwordError = document.getElementById('passwordError');
      const submitButton = document.getElementById('submitButton');
      const form = document.getElementById('registerForm');

      function validatePasswords() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword && confirmPassword !== '') {
          passwordError.style.display = 'block';
          confirmPasswordInput.classList.add('is-invalid');
          submitButton.disabled = true;
          return false;
        } else {
          passwordError.style.display = 'none';
          confirmPasswordInput.classList.remove('is-invalid');
          submitButton.disabled = false;
          return true;
        }
      }

      // Validasi real-time saat mengetik
      passwordInput.addEventListener('input', validatePasswords);
      confirmPasswordInput.addEventListener('input', validatePasswords);

      // Validasi sebelum submit form
      form.addEventListener('submit', function(e) {
        if (!validatePasswords()) {
          e.preventDefault();
          alert('Password dan konfirmasi password harus sama!');
        }
      });
    });
  </script>

</body>
</html>