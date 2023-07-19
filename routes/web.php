<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;


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

    // Brand:保存処理のルート
    Route::post('/store/brand', 'StoreBrand')
      ->name('store.brand');

    // Brand:編集処理のルート
    Route::get('/edit/brand/{id}', 'EditBrand')
      ->name('edit.brand');

    // Brand:更新処理のルート
    Route::post('/update/brand', 'UpdateBrand')
      ->name('update.brand');

    // Brand:削除処理のルート
    Route::get('/delete/brand/{id}', 'DeleteBrand')
      ->name('delete.brand');
  });

  // Category All Route 
  Route::controller(CategoryController::class)->group(function () {

    // Category:一覧のルート
    Route::get('/all/category', 'AllCategory')
      ->name('all.category');

    // Category:追加処理のルート
    Route::get('/add/category', 'AddCategory')
      ->name('add.category');

    // Category:保存処理のルート
    Route::post('/store/category', 'StoreCategory')
      ->name('store.category');

    // Category:編集のルート
    Route::get('/edit/category/{id}', 'EditCategory')
      ->name('edit.category');

    // Category:更新処理のルート
    Route::post('/update/category', 'UpdateCategory')
      ->name('update.category');

    // Category:削除処理のルート
    Route::get('/delete/category/{id}', 'DeleteCategory')
      ->name('delete.category');
  });

  // SubCategory All Route 
  Route::controller(SubCategoryController::class)->group(function () {

    // subcategory:一覧のルート
    Route::get('/all/subcategory', 'AllSubCategory')
      ->name('all.subcategory');

    // subcategory:新規作成のルート
    Route::get('/add/subcategory', 'AddSubCategory')
      ->name('add.subcategory');

    // subcategory:保存処理のルート
    Route::post('/store/subcategory', 'StoreSubCategory')
      ->name('store.subcategory');

    // subcategory:編集のルート
    Route::get('/edit/subcategory/{id}', 'EditSubCategory')
      ->name('edit.subcategory');

    // subcategory:更新処理のルート
    Route::post('/update/subcategory', 'UpdateSubCategory')
      ->name('update.subcategory');

    // subcategory:削除処理のルート
    Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')
      ->name('delete.subcategory');
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
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])
  ->name('vendor.login');

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])
  ->name('become.vendor');

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
