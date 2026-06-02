<?php

use Illuminate\Support\Facades\Route;

// Route patterns
Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name('home');

// Auth Routes
Route::get('/login', [\App\Http\Controllers\Login::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\Login::class, 'index'])->name('login.proses');

Route::get('/register', [\App\Http\Controllers\Register::class, 'index'])->name('register');
Route::post('/register', [\App\Http\Controllers\Register::class, 'proses'])->name('register.proses');

Route::get('/logout', [\App\Http\Controllers\Logout::class, 'index'])->name('logout');

// Forgot Password Routes
Route::get('/lupapassword', [\App\Http\Controllers\Lupapassword::class, 'index'])->name('lupapassword');
Route::post('/lupapassword', [\App\Http\Controllers\Lupapassword::class, 'sendReset'])->name('lupapassword.sendReset');
Route::post('/lupapassword/sendReset', [\App\Http\Controllers\Lupapassword::class, 'sendReset']);
Route::get('/lupapassword/verify', [\App\Http\Controllers\Lupapassword::class, 'verify'])->name('lupapassword.verify');
Route::post('/lupapassword/verify', [\App\Http\Controllers\Lupapassword::class, 'submitOtp'])->name('lupapassword.submitOtp');
Route::post('/lupapassword/submitOtp', [\App\Http\Controllers\Lupapassword::class, 'submitOtp']);
Route::get('/lupapassword/reset', [\App\Http\Controllers\Lupapassword::class, 'reset'])->name('lupapassword.reset');
Route::post('/lupapassword/reset', [\App\Http\Controllers\Lupapassword::class, 'reset']);
Route::post('/lupapassword/updatePassword', [\App\Http\Controllers\Lupapassword::class, 'reset']);

// Main Routes
Route::get('/katalog', [\App\Http\Controllers\DaftarMitra::class, 'index'])->name('katalog');
Route::get('/jualan', [\App\Http\Controllers\Jualan::class, 'index'])->name('jualan');
Route::get('/tentang', [\App\Http\Controllers\Tentang::class, 'index'])->name('tentang');
Route::get('/caribahanbaku', [\App\Http\Controllers\Caribahanbaku::class, 'index'])->name('caribahanbaku');
Route::get('/detail/{id}', [\App\Http\Controllers\Detail::class, 'index'])->name('detail');
Route::get('/checkout/{id}', [\App\Http\Controllers\Checkout::class, 'index'])->name('checkout');

// User Routes
Route::get('/profile', [\App\Http\Controllers\Profile::class, 'index'])->name('profile');
Route::get('/produksaya', [\App\Http\Controllers\Produksaya::class, 'index'])->name('produksaya');
Route::get('/produksaya/edit/{id}', [\App\Http\Controllers\Produksaya::class, 'edit'])->name('produksaya.edit');
Route::get('/order', [\App\Http\Controllers\Order::class, 'index'])->name('order');
Route::get('/verifikasiakun', [\App\Http\Controllers\Verifikasiakun::class, 'index'])->name('verifikasiakun');
Route::post('/verifikasiakun/submit', [\App\Http\Controllers\Verifikasiakun::class, 'submit'])->name('verifikasiakun.submit');

// Admin Routes
Route::get('/dashboardadmin', [\App\Http\Controllers\Dashboardadmin::class, 'index'])->name('dashboardadmin');

// 404 Fallback
Route::fallback([\App\Http\Controllers\NotFound::class, 'index']);

Route::get('/test-session', function () {
    $_SESSION['test'] = 'hello';
    return 'Session set. <a href="/test-session2">Next</a>';
});
Route::get('/test-session2', function () {
    return 'Session value: ' . ($_SESSION['test'] ?? 'NONE');
});

Route::get('/test-redirect', function () {
    $_SESSION['test_redirect'] = 'It works!';
    return redirect('/test-redirect2');
});
Route::get('/test-redirect2', function () {
    return 'Value: ' . ($_SESSION['test_redirect'] ?? 'LOST');
});

Route::get('/test-login', function () {
    require_once app_path('Models/AkunModel.php');
    $model = new AkunModel();
    $user = $model->getAkunByEmail('Findorizhanta05@gmail.com');
    if (!$user) return 'User not found';
    return 'User found! Password matches admin? ' . (password_verify('admin', $user['password']) ? 'YES' : 'NO');
});
