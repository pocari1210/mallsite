<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;


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

Route::middleware(['auth', 'role:admin'])->group(function () {

  // Brand All Route 
  Route::controller(BrandController::class)->group(function () {
    Route::get('/all/brand', 'AllBrand')
      ->name('all.brand');

    // Brand:追加処理のルート
    Route::get('/add/brand', 'AddBrand')
      ->name('add.brand');
  });
}); // End Middleware 

// Admin:ログイン処理のルート
Route::get('/admin/login', [AdminController::class, 'AdminLogin']);

// ★Vendor権限のルート★
Route::middleware(['auth', 'role:vendor'])->group(function () {
  Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])
    ->name('vendor.dashboard');

  // Vendor:ログアウト処理のルート
  Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])
    ->name('vendor.logout');

  // Vendor:プロフィール詳細ページのルート
  Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])
    ->name('vendor.profile');

  // Vendor:プロフィール情報更新のルート
  Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])
    ->name('vendor.profile.store');

  // Vendor:パスワード変更ページのルート
  Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])
    ->name('vendor.change.password');

  // Vendor:パスワード変更処理のルート
  Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])
    ->name('vendor.update.password');
});

// Vendor:ログイン処理のルート
Route::get('/vendor/login', [VendorController::class, 'VendorLogin']);

// Frontend:トップページのルート
Route::get('/', function () {
  return view('frontend.index');
});

// ★User権限のルート★
Route::middleware(['auth'])->group(function () {

  Route::get('/dashboard', [UserController::class, 'UserDashboard'])
    ->name('dashboard');

  Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])
    ->name('user.profile.store');

  // User:ログアウト処理のルート
  Route::get('/user/logout', [UserController::class, 'UserLogout'])
    ->name('user.logout');

  // User:パスワード変更処理のルート
  Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])
    ->name('user.update.password');
}); // Gorup Milldeware End

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
