<?php

use Illuminate\Support\Facades\Route;

// Route patterns
Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name('home');

// Auth Routes
Route::get('/login', [\App\Http\Controllers\Login::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\Login::class, 'index'])->name('login.proses');

Route::get('/register', [\App\Http\Controllers\Register::class, 'index'])->name('register');
Route::post('/register', [\App\Http\Controllers\Register::class, 'proses'])->name('register.proses');
Route::post('/register/proses', [\App\Http\Controllers\Register::class, 'proses']);

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
Route::post('/jualan/proses', [\App\Http\Controllers\Jualan::class, 'proses'])->name('jualan.proses');
Route::get('/tentang', [\App\Http\Controllers\Tentang::class, 'index'])->name('tentang');
Route::get('/caribahanbaku', [\App\Http\Controllers\Caribahanbaku::class, 'index'])->name('caribahanbaku');
Route::get('/detail/{id}', [\App\Http\Controllers\Detail::class, 'index'])->name('detail');
Route::get('/checkout/{id}', [\App\Http\Controllers\Checkout::class, 'index'])->name('checkout');
Route::post('/checkout/{id}', [\App\Http\Controllers\Checkout::class, 'proses'])->name('checkout.proses');

// User Routes
Route::get('/tokosaya', [\App\Http\Controllers\Tokosaya::class, 'index'])->name('tokosaya');
Route::get('/profile', [\App\Http\Controllers\Profile::class, 'index'])->name('profile');
Route::post('/profile/updatePhoto', [\App\Http\Controllers\Profile::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::post('/profile/updateNama', [\App\Http\Controllers\Profile::class, 'updateNama'])->name('profile.updateNama');
Route::post('/profile/sendOtp', [\App\Http\Controllers\Profile::class, 'sendOtp'])->name('profile.sendOtp');
Route::post('/profile/verifyOtp', [\App\Http\Controllers\Profile::class, 'verifyOtp'])->name('profile.verifyOtp');
Route::get('/produksaya', [\App\Http\Controllers\Produksaya::class, 'index'])->name('produksaya');
Route::get('/produksaya/edit/{id}', [\App\Http\Controllers\Produksaya::class, 'edit'])->name('produksaya.edit');
Route::post('/produksaya/update', [\App\Http\Controllers\Produksaya::class, 'update'])->name('produksaya.update');
Route::get('/produksaya/hapus/{id}', [\App\Http\Controllers\Produksaya::class, 'hapus'])->name('produksaya.hapus');
Route::get('/pesanansaya', [\App\Http\Controllers\Pesanansaya::class, 'index'])->name('pesanansaya');
Route::post('/pesanansaya/rate', [\App\Http\Controllers\Pesanansaya::class, 'rate'])->name('pesanansaya.rate');
Route::get('/order', [\App\Http\Controllers\Order::class, 'index'])->name('order');
Route::post('/order/respon/{order_id}', [\App\Http\Controllers\Order::class, 'respon'])->name('order.respon');
Route::get('/verifikasiakun', [\App\Http\Controllers\Verifikasiakun::class, 'index'])->name('verifikasiakun');
Route::post('/verifikasiakun/submit', [\App\Http\Controllers\Verifikasiakun::class, 'submit'])->name('verifikasiakun.submit');

// Admin Routes
Route::get('/dashboardadmin', [\App\Http\Controllers\Dashboardadmin::class, 'index'])->name('dashboardadmin');
Route::get('/dashboardadmin/setujui/{v_id}/{akun_id}', [\App\Http\Controllers\Dashboardadmin::class, 'setujui'])->name('dashboardadmin.setujui');
Route::get('/dashboardadmin/tolak/{v_id}/{akun_id}', [\App\Http\Controllers\Dashboardadmin::class, 'tolak'])->name('dashboardadmin.tolak');

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
