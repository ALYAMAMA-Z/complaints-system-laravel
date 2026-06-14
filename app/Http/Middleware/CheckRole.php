<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // إذا لم يكن المستخدم مسجل دخول، أعده إلى صفحة تسجيل الدخول
        if (! auth()->check()) {
            return redirect('http://127.0.0.1:8000/login');
        }

        // إذا كان مسجلاً ولكن ليس لديه الصلاحية المطلوبة
        if (auth()->user()->role !== $role) {
            abort(403, 'غير مصرح لك بالدخول. هذه الصفحة مخصصة للموظفين فقط.');
        }

        return $next($request);
    }
}
