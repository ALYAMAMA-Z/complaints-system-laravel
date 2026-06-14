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
            background-color: #fdfaf3;
        }
        .navbar-custom {
            background-color: #2b5e2b;
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
            background-color: #8b5a2b;
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
        .btn-group {
            display: flex;
            gap: 5px;
        }
        .btn-warning {
            background-color: #f0ad4e;
            border-color: #ec971f;
        }
        .btn-success {
            background-color: #5cb85c;
            border-color: #4cae4c;
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
                                <th>الصورة</th>
                                <th>إجراءات</th>
                                <th>الموقع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $complaint)
                            <tr>
                                <!-- الاسم -->
                                <td>{{ $complaint->citizen_name }}</td>
                                <!-- الوصف -->
                                <td>{{ \Illuminate\Support\Str::limit($complaint->description, 50) }}</td>
                                <!-- الحالة -->
                                <td>
                                    @if($complaint->status == 'pending')
                                        <span class="badge-status">⏳ قيد الانتظار</span>
                                    @elseif($complaint->status == 'in_progress')
                                        <span class="badge-status">🛠️ قيد المعالجة</span>
                                    @else
                                        <span class="badge-status">✅ تم الحل</span>
                                    @endif
                                </td>
                                <!-- تاريخ الإرسال -->
                                <td>{{ $complaint->created_at->format('Y-m-d') }}</td>
                                <!-- الصورة -->
                                <td>
                                    @if($complaint->image)
                                        <a href="{{ asset('storage/' . $complaint->image) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $complaint->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
                                        </a>
                                    @else
                                        <span class="text-muted">لا توجد صورة</span>
                                    @endif
                                </td>
                                <!-- الإجراءات (أزرار تغيير الحالة) -->
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('complaints.updateStatus', $complaint->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="in_progress">
                                            <button type="submit" class="btn btn-sm btn-warning" {{ $complaint->status == 'in_progress' ? 'disabled' : '' }}>
                                                🛠️ قيد المعالجة
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('complaints.updateStatus', $complaint->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="resolved">
                                            <button type="submit" class="btn btn-sm btn-success" {{ $complaint->status == 'resolved' ? 'disabled' : '' }}>
                                                ✅ تم الحل
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
    @if($complaint->latitude && $complaint->longitude)
        <button class="btn btn-sm btn-info" onclick="showLocation({{ $complaint->latitude }}, {{ $complaint->longitude }}, '{{ $complaint->citizen_name }}')">
            <i class="fas fa-map"></i> عرض الخريطة
        </button>
    @else
        <span class="text-muted">لا يوجد موقع</span>
    @endif
</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">لا توجد شكاوى حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- خريطة لعرض موقع الشكوى المحددة -->
<div class="card mt-4">
    <div class="card-header" style="background-color: #2b5e2b; color: white;">
        <i class="fas fa-map-marker-alt"></i> خريطة موقع الشكوى
    </div>
    <div class="card-body">
        <div id="map" style="height: 400px; width: 100%; border-radius: 12px;"></div>
        <p class="text-muted mt-2 text-center" id="selectedCoords">
            اضغط على أي شكوى لعرض موقعها على الخريطة
        </p>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script>
    // تهيئة الخريطة
    var map = L.map('map').setView([33.5138, 36.2765], 13);
    var marker;
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> & CartoDB',
        subdomains: 'abcd',
        maxZoom: 19
    }).addTo(map);
    
    // دالة لعرض موقع على الخريطة
    function showLocation(lat, lng, title) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map);
        map.setView([lat, lng], 15);
        document.getElementById('selectedCoords').innerHTML = 
            '<i class="fas fa-map-pin text-success"></i> ' + title + ' - الموقع: ' + lat.toFixed(6) + ', ' + lng.toFixed(6);
    }
</script>
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