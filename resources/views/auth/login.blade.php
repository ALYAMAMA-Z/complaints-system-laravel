<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - بلديتي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #fdfaf3 0%, #f4ede3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(43, 94, 43, 0.1);
            padding: 2rem;
            max-width: 450px;
            width: 100%;
            margin: 20px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h2 {
            color: #2b5e2b;
            font-weight: 800;
        }
        .login-header p {
            color: #8b5a2b;
        }
        .form-label {
            font-weight: 600;
            color: #2b5e2b;
        }
        .form-control {
            border-radius: 20px;
            border: 1px solid #d4c5b0;
            padding: 0.8rem 1rem;
        }
        .form-control:focus {
            border-color: #2b5e2b;
            box-shadow: 0 0 0 0.2rem rgba(43, 94, 43, 0.25);
        }
        .btn-login {
            background-color: #2b5e2b;
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s;
            width: 100%;
            color: white;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #1f451f;
            transform: translateY(-2px);
        }
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .register-link a {
            color: #2b5e2b;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1rem 0;
        }
        .remember-me label {
            margin-right: 0.5rem;
            color: #2b5e2b;
        }
        .forgot-password a {
            color: #8b5a2b;
            text-decoration: none;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2>🏛️ تسجيل الدخول</h2>
            <p>مرحباً بعودتك! أدخل بياناتك للدخول إلى لوحة التحكم</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="remember-me">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">تذكرني</label>
                </div>
                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-login">تسجيل الدخول</button>

            <div class="register-link">
                ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a>
            </div>
        </form>
    </div>
</body>
</html>