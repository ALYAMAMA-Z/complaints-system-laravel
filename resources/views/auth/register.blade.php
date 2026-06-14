<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - بلديتي</title>
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
        .register-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(43, 94, 43, 0.1);
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            margin: 20px;
        }
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .register-header h2 {
            color: #2b5e2b;
            font-weight: 800;
        }
        .register-header p {
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
        .btn-register {
            background-color: #8b5a2b;
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s;
            width: 100%;
            color: white;
            font-weight: 600;
        }
        .btn-register:hover {
            background-color: #6e451f;
            transform: translateY(-2px);
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .login-link a {
            color: #2b5e2b;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <h2>🏛️ إنشاء حساب جديد</h2>
            <p>سجل الآن لتتمكن من متابعة شكاويك</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">الاسم الكامل</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
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

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-register">تسجيل حساب</button>

            <div class="login-link">
                لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a>
            </div>
        </form>
    </div>
</body>
</html>