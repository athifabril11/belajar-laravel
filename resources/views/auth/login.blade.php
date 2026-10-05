<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - POS Toko Kelontong</title>
  
  <link rel="icon" type="image/png" href="{{ asset('admin/assets/images/favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }}">

  <style>
    body.login-page {
      background: #f4f6f8;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }
    .login-card {
      width: 100%;
      max-width: 440px;
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      background: #ffffff;
      padding: 2.5rem;
    }
    .login-brand {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      font-size: 1.5rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 0.5rem;
      text-decoration: none;
    }
    .login-brand i {
      color: #b4f105;
      font-size: 1.75rem;
    }
    .btn-login {
      background-color: #1e293b;
      color: #ffffff;
      font-weight: 600;
      padding: 0.75rem 1.25rem;
      border-radius: 0.5rem;
      border: none;
      width: 100%;
      transition: all 0.2s;
    }
    .btn-login:hover {
      background-color: #0f172a;
      color: #b4f105;
    }
  </style>
</head>
<body class="login-page">
  <div class="login-card">
    <div class="text-center mb-4">
      <a href="{{ route('home') }}" class="login-brand">
        <i class="bi bi-asterisk"></i>
        <span>POS Toko Kelontong</span>
      </a>
      <p class="text-muted small">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label font-semibold text-sm">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="admin@minimarket.test">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label font-semibold text-sm mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-primary text-decoration-none" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                <input id="password" type="password" name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       required autocomplete="current-password"
                       placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-4">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label text-sm text-muted">
                Ingat saya di perangkat ini
            </label>
        </div>

        <button type="submit" class="btn btn-login mb-3">
            Log In <i class="bi bi-arrow-right ms-1"></i>
        </button>

        <div class="text-center pt-2 border-top">
            <small class="text-muted">Demo Akun Login:</small><br>
            <small class="text-muted"><strong>Admin:</strong> admin@minimarket.test | password</small><br>
            <small class="text-muted"><strong>Kasir:</strong> kasir@minimarket.test | password</small>
        </div>
    </form>
  </div>

  <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
