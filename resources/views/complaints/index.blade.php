<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة الشكاوى - بلديتي</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap RTL + خط عربي -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- خط Google: Noto Sans Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Arabic', sans-serif;
            background-color: #fdfaf3; /* أبيض عاجي ناعم */
        }
        .navbar-custom {
            background-color: #2b5e2b; /* أخضر زيتوني غامق */
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fdfaf3;
        }
        .btn-primary {
            background-color: #2b5e2b;
            border-color: #1f451f;
        }
        .btn-primary:hover {
            background-color: #1f451f;
        }
        .btn-success {
            background-color: #8b5a2b; /* بني ترابي */
            border-color: #6e451f;
        }
        .btn-success:hover {
            background-color: #6e451f;
        }
        .card-header {
            background-color: #2b5e2b;
            color: white;
        }
        .badge-status {
            background-color: #e9ecef;
            color: #8b5a2b;
            padding: 0.3rem 0.6rem;
            border-radius: 30px;
            font-size: 0.8rem;
        }
        footer {
            background-color: #2b5e2b;
            color: #fdfaf3;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">🏛️ بلديتي - سوريا</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('complaints.create') }}">➕ شكوى جديدة</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col text-center">
                <h2>📋 قائمة الشكاوى الواردة</h2>
                <p class="text-muted">مرحباً بك في لوحة تحكم بلديتي – نعمل معاً من أجل حي أفضل</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header">جميع الشكاوى</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>الاسم</th>
                                <th>الوصف</th>
                                <th>الحالة</th>
                                <th>تاريخ الإرسال</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->citizen_name }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($complaint->description, 50) }}</td>
                                <td>
                                    @if($complaint->status == 'pending')
                                        <span class="badge-status">⏳ قيد الانتظار</span>
                                    @elseif($complaint->status == 'in_progress')
                                        <span class="badge-status">🛠️ قيد المعالجة</span>
                                    @else
                                        <span class="badge-status">✅ تم الحل</span>
                                    @endif
                                </td>
                                <td>{{ $complaint->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">لا توجد شكاوى حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2026 بلديتي – خدمة المواطن السوري | جميع الحقوق محفوظة</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>