<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;


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

    Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
  });

  // Vendor Active and Inactive All Route 
  Route::controller(AdminController::class)->group(function () {

    // InactiveVendor:一覧のルート
    Route::get('/inactive/vendor', 'InactiveVendor')
      ->name('inactive.vendor');

    // ActiveVendor:一覧のルート
    Route::get('/active/vendor', 'ActiveVendor')
      ->name('active.vendor');

    // InactiveVendor:詳細表示のルート
    Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')
      ->name('inactive.vendor.details');

    // InactiveVendor:承認のルート(ステータス変更)
    Route::post('/active/vendor/approve', 'ActiveVendorApprove')
      ->name('active.vendor.approve');

    // ActiveVendor:詳細のルート
    Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')
      ->name('active.vendor.details');

    // ActiveVendor:ステータス変更のルート
    Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')
      ->name('inactive.vendor.approve');
  });

  // Product All Route 
  Route::controller(ProductController::class)->group(function () {

    // Product:一覧表示のルート
    Route::get('/all/product', 'AllProduct')
      ->name('all.product');

    // Product:追加ページのルート
    Route::get('/add/product', 'AddProduct')
      ->name('add.product');

    // Product:保存処理のルート
    Route::post('/store/product', 'StoreProduct')
      ->name('store.product');

    // Product:編集ページのルート
    Route::get('/edit/product/{id}', 'EditProduct')
      ->name('edit.product');

    // Product:更新処理のルート
    Route::post('/update/product', 'UpdateProduct')
      ->name('update.product');

    // Product:画像の更新処理のルート
    Route::post('/update/product/thambnail', 'UpdateProductThambnail')
      ->name('update.product.thambnail');

    // Product:複数画像の更新処理のルート
    Route::post('/update/product/multiimage', 'UpdateProductMultiimage')
      ->name('update.product.multiimage');

    // Product:複数画像の削除処理のルート
    Route::get('/product/multiimg/delete/{id}', 'MulitImageDelelte')
      ->name('product.multiimg.delete');

    // Product:inactiveのルート
    Route::get('/product/inactive/{id}', 'ProductInactive')
      ->name('product.inactive');

    // Product:activeのルート
    Route::get('/product/active/{id}', 'ProductActive')
      ->name('product.active');

    // Productの削除処理
    Route::get('/delete/product/{id}', 'ProductDelete')
      ->name('delete.product');
  });
}); // End Middleware 

// Admin:ログイン処理のルート
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])
  ->middleware(RedirectIfAuthenticated::class);

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

  // Vendor Add Product All Route 
  Route::controller(VendorProductController::class)->group(function () {

    // VendorProduct:一覧表示のルート
    Route::get('/vendor/all/product', 'VendorAllProduct')
      ->name('vendor.all.product');

    // VendorProduct:追加ページのルート
    Route::get('/vendor/add/product', 'VendorAddProduct')
      ->name('vendor.add.product');

    // VendorProduct:保存処理のルート
    Route::post('/vendor/store/product', 'VendorStoreProduct')
      ->name('vendor.store.product');

    // VendorProduct:編集ページのルート
    Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')
      ->name('vendor.edit.product');

    // VendorProduct:更新処理のルート
    Route::post('/vendor/update/product', 'VendorUpdateProduct')
      ->name('vendor.update.product');

    // VendorProduct:画像の更新のルート      
    Route::post('/vendor/update/product/thambnail', 'VendorUpdateProductThabnail')
      ->name('vendor.update.product.thambnail');

    // VendorProduct:複数画像の更新のルート    
    Route::post('/vendor/update/product/multiimage', 'VendorUpdateProductmultiImage')
      ->name('vendor.update.product.multiimage');

    // VendorProduct:複数画像の削除のルート          
    Route::get('/vendor/product/multiimg/delete/{id}', 'VendorMultiimgDelete')
      ->name('vendor.product.multiimg.delete');

    Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
  });
});

// Vendor:ログイン処理のルート
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])
  ->name('vendor.login')
  ->middleware(RedirectIfAuthenticated::class);

// Vendor:登録ページのルート
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])
  ->name('become.vendor');

// Vendor:登録処理のルート
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])
  ->name('vendor.register');

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
