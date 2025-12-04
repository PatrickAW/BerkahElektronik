@extends('products.layoutlogin')

@section('title', 'Toko Berkah Elektronik - Login')

@section('content')
<style>
  /* ===== HANYA ATUR FORM LOGIN ===== */
  /* TIDAK ADA CSS UNTUK NAVBAR DI SINI */
  
  .login-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
  }
  
  .login-container {
    max-width: 900px;
    margin: 0 auto;
  }
  
  .login-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
  }
  
  .login-left {
    flex: 1;
    min-width: 300px;
    padding-right: 60px;
  }
  
  .login-right {
    flex: 1;
    min-width: 300px;
    max-width: 450px;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  }
  
  .login-header h1 {
    font-weight: 600;
    font-size: 32px;
    color: #333;
    margin-bottom: 15px;
    line-height: 1.3;
  }
  
  .form-label {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
    display: block;
  }
  
  .input-field {
    border-radius: 8px;
    padding: 12px 16px;
    border: 1px solid #ddd;
    background: #fff;
    width: 100%;
    font-size: 14px;
  }
  
  .input-field:focus {
    border-color: #2948ff;
    box-shadow: 0 0 0 0.2rem rgba(41, 72, 255, 0.15);
    outline: none;
  }
  
  .password-group {
    display: flex;
    margin-bottom: 5px;
  }
  
  .password-group input {
    border-radius: 8px 0 0 8px;
    border-right: none;
  }
  
  .toggle-password-btn {
    border-radius: 0 8px 8px 0;
    border: 1px solid #ddd;
    border-left: none;
    background-color: #f8f9fa;
    padding: 0 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .forgot-password {
    text-align: right;
    margin-top: 8px;
  }
  
  .forgot-password a {
    color: #2948ff;
    font-size: 14px;
    text-decoration: none;
  }
  
  .login-btn {
    background-color: #2948ff;
    color: #fff;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    font-weight: 500;
    padding: 14px;
    width: 100%;
    cursor: pointer;
    margin-top: 10px;
  }
  
  .login-btn:hover {
    background-color: #1c36cc;
  }
  
  .divider {
    position: relative;
    text-align: center;
    margin: 30px 0;
  }
  
  .divider hr {
    border: none;
    border-top: 1px solid #eee;
    margin: 0;
  }
  
  .divider span {
    position: absolute;
    top: -10px;
    background: white;
    padding: 0 15px;
    color: #666;
    font-size: 14px;
    left: 50%;
    transform: translateX(-50%);
  }
  
  .register-btn {
    border-radius: 8px;
    border: 1.5px solid #333;
    color: #333;
    background: #fff;
    font-size: 16px;
    font-weight: 500;
    padding: 14px;
    width: 100%;
    text-align: center;
    text-decoration: none;
    display: block;
  }
  
  .register-btn:hover {
    border-color: #2948ff;
    color: #2948ff;
  }
  
  @media (max-width: 768px) {
    .login-row {
      flex-direction: column;
    }
    
    .login-left {
      padding-right: 0;
      margin-bottom: 30px;
      text-align: center;
    }
    
    .login-right {
      padding: 30px;
    }
    
    .login-header h1 {
      font-size: 28px;
    }
  }
  
  @media (max-width: 576px) {
    .login-header h1 {
      font-size: 24px;
    }
    
    .login-right {
      padding: 25px;
    }
  }
</style>

<section class="login-section">
  <div class="login-container">
    <div class="login-row">
      <div class="login-left">
        <div class="login-header">
          <h1><b>Silahkan masuk <br> ke akun anda</b></h1>
        </div>
      </div>
      
      <div class="login-right">
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          
          <div class="mb-4">
            <label class="form-label">Masukan email yang terdaftar</label>
            <input 
              type="email" 
              class="input-field" 
              name="email" 
              placeholder="contoh@email.com" 
              required 
              value="{{ old('email') }}"
            >
            @error('email')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Kata Sandi</label>
            <div class="password-group">
              <input 
                type="password" 
                class="input-field" 
                name="password" 
                placeholder="Kata sandi" 
                required 
                id="passwordInput"
              >
              <button 
                class="toggle-password-btn" 
                type="button" 
                id="togglePassword"
              >
                <i class="bi bi-eye"></i>
              </button>
            </div>
            <div class="forgot-password">
              <a href="{{ route('reset.password') }}">
                Lupa kata sandi?
              </a>
            </div>
            @error('password')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          @if(session('error'))
            <div class="alert alert-danger py-2 mb-3">
              {{ session('error') }}
            </div>
          @endif
          
          @if(session('success'))
            <div class="alert alert-success py-2 mb-3">
              {{ session('success') }}
            </div>
          @endif

          <div class="d-grid mb-3">
            <button type="submit" class="login-btn">
              Masuk
            </button>
          </div>

          <div class="divider">
            <hr>
            <span>atau</span>
          </div>

          <div class="d-grid">
            <a href="{{ route('register') }}" class="register-btn">
              Daftar sekarang?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('passwordInput');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
    }
  });
</script>
@endsection