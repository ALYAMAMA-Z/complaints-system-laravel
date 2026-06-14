<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('complaints.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes الخاصة بالشكاوى (محمية بـ auth و role:employee)
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::resource('complaints', ComplaintController::class);
    Route::patch('/complaints/{id}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
});

require __DIR__.'/auth.php';
