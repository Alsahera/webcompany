<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LaKost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --kf-primary: #1A56DB;
            --kf-dark:    #0F172A;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px rgba(26,86,219,0.15);
            width: 100%;
            max-width: 440px;
        }
        .brand-icon {
            width: 52px; height: 52px;
            background: var(--kf-primary);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            margin: 0 auto 16px;
        }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #E2E8F0;
            padding: 12px 16px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
        }
        .form-control:focus {
            border-color: var(--kf-primary);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.10);
        }
        .btn-primary {
            background: var(--kf-primary);
            border-color: var(--kf-primary);
            border-radius: 10px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: 12px;
        }
        .btn-primary:hover { background: #1447C0; }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1.5px solid #E2E8F0;
            background: #F8FAFC;
        }
        .input-group .form-control { border-left: none; border-radius: 0 10px 10px 0; }
        .toggle-password { cursor: pointer; border-radius: 0 10px 10px 0; border: 1.5px solid #E2E8F0; border-left: none; }
    </style>
</head>
<body>
    <div class="login-card">
        {{-- Brand --}}
        <div class="text-center mb-4">
            <div class="brand-icon"><i class="bi bi-house-heart-fill"></i></div>
            <h1 style="font-size:1.7rem;font-weight:800;color:var(--kf-dark);">La<span style="color:var(--kf-primary);">Kost</span></h1>
            <p class="text-muted mb-0" style="font-size:0.9rem;">Masuk ke panel admin</p>
        </div>

        {{-- Flash messages --}}
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                    Email <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="admin@lakos.com"
                           autocomplete="email"
                           required>
                </div>
                @error('email')
                    <div class="text-danger mt-1" style="font-size:0.82rem;"><i class="bi bi-x-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                    Password <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password"
                           id="passwordInput"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Masukkan password"
                           autocomplete="current-password"
                           required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger mt-1" style="font-size:0.82rem;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember" style="font-size:0.87rem;">Ingat saya</label>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100 py-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
            </button>
        </form>

        {{-- Demo info --}}
        <div class="mt-4 p-3 rounded-3" style="background:#F0F9FF;border:1px solid #BAE6FD;">
            <p class="mb-1" style="font-size:0.8rem;font-weight:700;color:#0369A1;">
                <i class="bi bi-info-circle me-1"></i>Akun Demo
            </p>
            <p class="mb-0" style="font-size:0.8rem;color:#0369A1;">
                Email: <strong>admin@lakos.com</strong><br>
                Password: <strong>12345678</strong>
            </p>
        </div>

        <p class="text-center mt-3 mb-0" style="font-size:0.82rem;color:#94A3B8;">
            <a href="{{ route('home') }}" class="text-decoration-none" style="color:var(--kf-primary);">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>