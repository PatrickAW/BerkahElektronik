@extends('products.layoutlogin')

@section('title', 'Toko Berkah Elektronik - Reset Password')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

@section('content')

<style>
  /* --- CSS yang sudah kamu buat (AMAN) --- */
  body {
    background-color: #fff;
    overflow-x: hidden;
    font-family: Arial, sans-serif;
  }
  .reset-section {
    max-width: 1200px;
    margin: 0 auto;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    padding: 20px;
    background-color: transparent;
  }
  .reset-container { background-color: transparent; max-width: 900px; margin: 0 auto; }
  .reset-row { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; }
  .reset-left { flex: 1; min-width: 300px; padding-right: 60px; }
  .reset-right { flex: 1; min-width: 300px; max-width: 450px; }
  .reset-header { margin-bottom: 0; }
  .reset-header h1 { font-weight: 600; font-size: 32px; color: #333; margin-bottom: 15px; line-height: 1.3; }
  .reset-header .subtitle { color: #666; font-size: 14px; margin-bottom: 8px; }
  .form-label { font-size: 14px; font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
  .input-field { border-radius: 8px; padding: 12px 16px; border: 1px solid #ddd; background: #fff; width: 100%; font-size: 14px; }
  .password-group { display: flex; }
  .password-group input { border-radius: 8px 0 0 8px; border-right: none; }
  .toggle-password-btn { border-radius: 0 8px 8px 0; border: 1px solid #ddd; border-left: none; background-color: #f8f9fa; padding: 0 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
  .required-star { color: #dc3545; }
  .error-message { color: #dc3545; font-size: 12px; margin-top: 4px; }
  .password-mismatch { color: #dc3545; font-size: 12px; margin-top: 4px; }
  .continue-btn { background-color: #2948ff; color: #fff; border-radius: 8px; border: none; font-size: 16px; font-weight: 500; padding: 14px; width: 100%; cursor: pointer; margin-top: 10px; }
  .divider { position: relative; text-align: center; margin: 30px 0; }
  .divider hr { border: none; border-top: 1px solid #eee; margin: 0; }

  @media (max-width: 768px) {
    .reset-section { padding: 15px; top: 50%; }
    .reset-row { flex-direction: column; }
    .reset-left { padding-right: 0; margin-bottom: 40px; text-align: center; }
    .reset-right { width: 100%; max-width: 400px; }
    .reset-header h1 { font-size: 28px; }
  }
</style>

<section class="reset-section">
  <div class="reset-container">
    <div class="reset-row">

      <div class="reset-left">
        <div class="reset-header">
          <h1><b>Lupa kata sandi?</b></h1>
          <p class="subtitle">Masukan kata sandi yang baru</p>
        </div>
      </div>

      <div class="reset-right">

        {{-- Pesan error/success --}}
        @if(session('error'))
          <div class="alert alert-danger" style="font-size:14px;border-radius:8px;">
            {{ session('error') }}
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success" style="font-size:14px;border-radius:8px;">
            {{ session('success') }}
          </div>
        @endif

        {{-- FORM RESET PASSWORD --}}
        <form method="POST" action="{{ url('/reset-password') }}" id="resetForm">
          @csrf

          <div class="mb-4">
            <label class="form-label">Email terdaftar <span class="required-star">*</span></label>
            <input type="email" name="email" class="input-field" required value="{{ old('email') }}" placeholder="contoh@email.com">
            @error('email') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <div class="mb-4">
            <label class="form-label">Kata sandi <span class="required-star">*</span></label>
            <div class="password-group">
              <input type="password" name="password" class="input-field" required id="newPassword">
              <button type="button" class="toggle-password-btn" id="toggleNewPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
            @error('password') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <div class="mb-4">
            <label class="form-label">Masukan ulang kata sandi <span class="required-star">*</span></label>
            <div class="password-group">
              <input type="password" name="password_confirmation" class="input-field" required id="confirmPassword">
              <button type="button" class="toggle-password-btn" id="toggleConfirmPassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
            <div id="passwordMatchError" class="password-mismatch" style="display:none;">Kata sandi berbeda</div>
          </div>

          <div class="divider"><hr></div>

          <button type="submit" class="continue-btn">Lanjutkan</button>

        </form>

      </div>

    </div>
  </div>
</section>

<script>
  // Toggle password
  const toggle = (btnId, inputId) => {
    const btn = document.getElementById(btnId);
    const input = document.getElementById(inputId);
    btn.addEventListener("click", () => {
      input.type = input.type === "password" ? "text" : "password";
      btn.querySelector("i").classList.toggle("bi-eye");
      btn.querySelector("i").classList.toggle("bi-eye-slash");
    });
  };
  toggle("toggleNewPassword", "newPassword");
  toggle("toggleConfirmPassword", "confirmPassword");

  // Form validation
  document.getElementById('resetForm').addEventListener('submit', function(e) {
    const p1 = document.getElementById('newPassword').value;
    const p2 = document.getElementById('confirmPassword').value;
    const error = document.getElementById('passwordMatchError');
    error.style.display = "none";

    if (p1 !== p2) {
      e.preventDefault();
      error.style.display = "block";
      return;
    }

    if (p1.length < 8) {
      e.preventDefault();
      alert("Kata sandi minimal 8 karakter");
    }
  });
</script>

@endsection
