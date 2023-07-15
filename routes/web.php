<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ★Admin権限のルート★
Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])
    ->name('admin.dashboard');

  // Admin:ログアウト処理のルート
  Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])
    ->name('admin.logout');

  // Admin:プロフィールページのルート
  Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])
    ->name('admin.profile');

  // Admin:プロフィール情報保存のルート
  Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])
    ->name('admin.profile.store');

  // Admin:パスワード変更のルート
  Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])
    ->name('admin.change.password');

  // Admin:パスワード更新のルート
  Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])
    ->name('update.password');
});

// Admin:ログイン処理のルート
Route::get('/admin/login', [AdminController::class, 'AdminLogin']);

Route::middleware(['auth', 'role:vendor'])->group(function () {
  Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])
    ->name('vendor.dashboard');
});

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
