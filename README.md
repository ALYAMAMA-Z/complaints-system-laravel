# نظام إدارة الشكاوى البلدية - الخلفية (Backend)

نظام متكامل لإدارة الشكاوى البلدية باستخدام Laravel، يتضمن واجهة ويب للموظفين و API لتطبيق الجوال.

## التقنيات المستخدمة

- Laravel 12
- MySQL
- PHP 8.2
- Laravel Sanctum (للمصادقة)
- Hugging Face API (للتصنيف الذكي)

## الميزات

- إرسال وعرض الشكاوى
- تصنيف تلقائي للشكاوى باستخدام الذكاء الاصطناعي (Rule-based)
- واجهة ويب للموظفين (لوحة تحكم)
- API كامل لتطبيق Flutter

## طريقة التثبيت والتشغيل

```bash
git clone https://github.com/ALYAMAMA-Z/complaints-system-laravel.git
cd complaints-system-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

app/
├── Http/Controllers/     # Web & API Controllers
├── Models/               # Complaint Model
├── Services/             # ComplaintService, HuggingFaceService
└── Http/Requests/        # StoreComplaintRequest