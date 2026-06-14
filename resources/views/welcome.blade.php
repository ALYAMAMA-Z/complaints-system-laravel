<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بلديتي - نظام إدارة الشكاوى البلدية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #fdfaf3 0%, #f4ede3 100%);
            min-height: 100vh;
        }
        .hero {
            background: url('https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=2070&auto=format') no-repeat center center;
            background-size: cover;
            position: relative;
            border-radius: 30px;
            margin: 20px;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(43, 94, 43, 0.85);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 80px 20px;
            text-align: center;
            color: white;
        }
        .btn-custom {
            background-color: #8b5a2b;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: 0.3s;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }
        .btn-custom:hover {
            background-color: #6e451f;
            transform: translateY(-3px);
            color: white;
        }
        .btn-outline-custom {
            background-color: transparent;
            border: 2px solid white;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: 0.3s;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }
        .btn-outline-custom:hover {
            background-color: white;
            color: #2b5e2b;
            transform: translateY(-3px);
        }
        .features {
            padding: 60px 0;
            text-align: center;
        }
        .feature-icon {
            font-size: 3rem;
            color: #2b5e2b;
            margin-bottom: 15px;
        }
        footer {
            background-color: #2b5e2b;
            color: #fdfaf3;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <div class="hero-content">
                <h1 style="font-size: 3rem; font-weight: 800;">🏛️ بلديتي - سوريا</h1>
                <p style="font-size: 1.3rem; margin-top: 20px;">نظام ذكي لإدارة الشكاوى البلدية</p>
                <p class="mb-4">سوياً نسمع صوتك ونعمل من أجل حي أفضل</p>
                <div>
                    <a href="{{ route('login') }}" class="btn-custom">تسجيل الدخول للموظفين</a>
                    <a href="{{ route('register') }}" class="btn-outline-custom">إنشاء حساب جديد</a>
                </div>
            </div>
        </div>

        <div class="features">
            <h2 style="color: #2b5e2b; font-weight: 800;">مميزات المنصة</h2>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="feature-icon">📝</div>
                    <h4>إرسال الشكاوى بسهولة</h4>
                    <p>عبر تطبيق الجوال أو الموقع</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">🤖</div>
                    <h4>تصنيف ذكي تلقائي</h4>
                    <p>باستخدام تقنيات الذكاء الاصطناعي</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">🗺️</div>
                    <h4>تحديد الموقع على الخريطة</h4>
                    <p>حتى بدون إنترنت</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2026 بلديتي – خدمة المواطن السوري | جميع الحقوق محفوظة</p>
    </footer>
</body>
</html>