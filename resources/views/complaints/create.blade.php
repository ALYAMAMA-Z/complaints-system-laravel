<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>شكوى جديدة - بلديتي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Arabic', sans-serif;
            background: linear-gradient(135deg, #fdfaf3 0%, #f4ede3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .complaint-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(43, 94, 43, 0.1);
            border: none;
            overflow: hidden;
        }
        .card-header-custom {
            background-color: #2b5e2b;
            padding: 1.5rem;
            text-align: center;
        }
        .card-header-custom h2 {
            color: white;
            margin: 0;
            font-weight: 500;
        }
        .btn-submit {
            background-color: #8b5a2b;
            border: none;
            padding: 12px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: #6e451f;
            transform: translateY(-2px);
        }
        .form-control, .form-select {
            border-radius: 20px;
            border: 1px solid #d4c5b0;
            padding: 0.8rem 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2b5e2b;
            box-shadow: 0 0 0 0.2rem rgba(43, 94, 43, 0.25);
        }
        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #2b5e2b;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="complaint-card">
                    <div class="card-header-custom">
                        <h2>📝 شكوى جديدة إلى البلدية</h2>
                        <p class="text-white-50 mt-2">سوريا – نسمع صوتك ونعمل من أجلك</p>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('complaints.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="citizen_name">الاسم الكامل</label>
                                <input type="text" name="citizen_name" id="citizen_name" class="form-control" placeholder="مثال: أحمد محمود" required>
                            </div>
                            <div class="mb-4">
                                <label for="description">وصف الشكوى</label>
                                <textarea name="description" id="description" rows="5" class="form-control" placeholder="اكتب تفاصيل الشكوى بوضوح (الموقع، نوع المشكلة، أي معلومات مفيدة)..."></textarea>
                                <div class="form-text text-muted">سنسعى لحل شكواك في أقرب وقت</div>
                            </div>
                            <button type="submit" class="btn btn-submit text-white w-100">إرسال الشكوى</button>
                        </form>
                    </div>
                    <div class="text-center pb-4">
                        <a href="{{ route('complaints.index') }}" class="text-decoration-none" style="color:#8b5a2b;">← العودة إلى قائمة الشكاوى</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>