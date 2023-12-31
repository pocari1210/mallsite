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
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\ReviewController;


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

    // For Product Stock
    Route::get('/product/stock', 'ProductStock')
      ->name('product.stock');
  });

  // Slider All Route 
  Route::controller(SliderController::class)->group(function () {

    // Slider：一覧表示のルート
    Route::get('/all/slider', 'AllSlider')
      ->name('all.slider');

    // Slider：追加ページのルート
    Route::get('/add/slider', 'AddSlider')
      ->name('add.slider');

    // Slider：保存処理のルート
    Route::post('/store/slider', 'StoreSlider')
      ->name('store.slider');

    // Slider：編集ページのルート
    Route::get('/edit/slider/{id}', 'EditSlider')
      ->name('edit.slider');

    // Slider：更新処理のルート
    Route::post('/update/slider', 'UpdateSlider')
      ->name('update.slider');

    // Slider：削除処理のルート
    Route::get('/delete/slider/{id}', 'DeleteSlider')
      ->name('delete.slider');
  });

  // Banner All Route 
  Route::controller(BannerController::class)->group(function () {

    // Banner：一覧ページのルート
    Route::get('/all/banner', 'AllBanner')
      ->name('all.banner');

    // Banner：追加ページのルート
    Route::get('/add/banner', 'AddBanner')
      ->name('add.banner');

    // Banner：保存処理のルート
    Route::post('/store/banner', 'StoreBanner')
      ->name('store.banner');

    // Banner：編集ページのルート
    Route::get('/edit/banner/{id}', 'EditBanner')
      ->name('edit.banner');

    // Banner：更新処理のルート
    Route::post('/update/banner', 'UpdateBanner')
      ->name('update.banner');

    // Banner：削除処理のルート
    Route::get('/delete/banner/{id}', 'DeleteBanner')
      ->name('delete.banner');
  });

  // Coupon All Route 
  Route::controller(CouponController::class)->group(function () {

    // クーポンの一覧表示のルート
    Route::get('/all/coupon', 'AllCoupon')
      ->name('all.coupon');

    // クーポンの追加のルート
    Route::get('/add/coupon', 'AddCoupon')
      ->name('add.coupon');

    // クーポンの保存処理のルート
    Route::post('/store/coupon', 'StoreCoupon')
      ->name('store.coupon');

    // クーポンの編集のルート
    Route::get('/edit/coupon/{id}', 'EditCoupon')
      ->name('edit.coupon');

    // クーポンの更新処理のルート
    Route::post('/update/coupon', 'UpdateCoupon')
      ->name('update.coupon');

    // クーポンの削除処理のルート
    Route::get('/delete/coupon/{id}', 'DeleteCoupon')
      ->name('delete.coupon');
  });

  // Shipping Division All Route 
  Route::controller(ShippingAreaController::class)->group(function () {

    // Divisionの一覧のルート
    Route::get('/all/division', 'AllDivision')
      ->name('all.division');

    // Divisionの追加のルート
    Route::get('/add/division', 'AddDivision')
      ->name('add.division');

    // Divisionの保存処理のルート
    Route::post('/store/division', 'StoreDivision')
      ->name('store.division');

    // Divisionの更新ページ遷移のルート
    Route::get('/edit/division/{id}', 'EditDivision')
      ->name('edit.division');

    // Divisionの更新処理のルート
    Route::post('/update/division', 'UpdateDivision')
      ->name('update.division');

    // Divisionの削除処理のルート
    Route::get('/delete/division/{id}', 'DeleteDivision')
      ->name('delete.division');
  });

  // Shipping District All Route 
  Route::controller(ShippingAreaController::class)->group(function () {

    // Districtの一覧のルート
    Route::get('/all/district', 'AllDistrict')
      ->name('all.district');

    // Districtの追加ページ遷移のルート
    Route::get('/add/district', 'AddDistrict')
      ->name('add.district');

    // Districtの保存処理のルート
    Route::post('/store/district', 'StoreDistrict')
      ->name('store.district');

    // Districtの編集ページ遷移のルート
    Route::get('/edit/district/{id}', 'EditDistrict')
      ->name('edit.district');

    // Districtの更新処理のルート
    Route::post('/update/district', 'UpdateDistrict')
      ->name('update.district');

    // Districtの削除処理のルート
    Route::get('/delete/district/{id}', 'DeleteDistrict')
      ->name('delete.district');
  });

  // Shipping State All Route 
  Route::controller(ShippingAreaController::class)->group(function () {

    // Stateの一覧のルート
    Route::get('/all/state', 'AllState')
      ->name('all.state');

    // Stateの追加ページ遷移のルート
    Route::get('/add/state', 'AddState')
      ->name('add.state');

    // Stateの保存処理のルート
    Route::post('/store/state', 'StoreState')
      ->name('store.state');

    // Stateの編集のルート
    Route::get('/edit/state/{id}', 'EditState')
      ->name('edit.state');

    // Stateの更新処理のルート
    Route::post('/update/state', 'UpdateState')
      ->name('update.state');

    // Stateの削除処理のルート
    Route::get('/delete/state/{id}', 'DeleteState')
      ->name('delete.state');

    Route::get('/district/ajax/{division_id}', 'GetDistrict');
  });

  // Admin Order All Route 
  Route::controller(OrderController::class)->group(function () {

    // Adminの注文のペンディング画面のルート
    Route::get('/pending/order', 'PendingOrder')
      ->name('pending.order');

    // Adminの注文の返品処理画面のルート
    Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')
      ->name('admin.order.details');

    Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')
      ->name('admin.confirmed.order');

    Route::get('/admin/processing/order', 'AdminProcessingOrder')
      ->name('admin.processing.order');

    Route::get('/admin/delivered/order', 'AdminDeliveredOrder')
      ->name('admin.delivered.order');

    Route::get('/pending/confirm/{order_id}', 'PendingToConfirm')
      ->name('pending-confirm');

    // ConfirmからProcessにステータス変更のルート
    Route::get('/confirm/processing/{order_id}', 'ConfirmToProcess')
      ->name('confirm-processing');

    // ProcessからDeliveredにステータス変更のルート
    Route::get('/processing/delivered/{order_id}', 'ProcessToDelivered')
      ->name('processing-delivered');

    Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')
      ->name('admin.invoice.download');
  });

  // Return Order All Route 
  Route::controller(ReturnController::class)->group(function () {

    Route::get('/return/request', 'ReturnRequest')
      ->name('return.request');

    Route::get('/return/request/approved/{order_id}', 'ReturnRequestApproved')
      ->name('return.request.approved');

    Route::get('/complete/return/request', 'CompleteReturnRequest')
      ->name('complete.return.request');
  });

  // Report All Route 
  Route::controller(ReportController::class)->group(function () {

    Route::get('/report/view', 'ReportView')
      ->name('report.view');

    // 購入履歴検索(日付)のルート
    Route::post('/search/by/date', 'SearchByDate')
      ->name('search-by-date');

    // 購入履歴検索(月単位)のルート
    Route::post('/search/by/month', 'SearchByMonth')
      ->name('search-by-month');

    // 購入履歴検索(年単位)のルート
    Route::post('/search/by/year', 'SearchByYear')
      ->name('search-by-year');

    Route::get('/order/by/user', 'OrderByUser')
      ->name('order.by.user');

    Route::post('/search/by/user', 'SearchByUser')
      ->name('search-by-user');
  });

  // Active user and vendor All Route 
  Route::controller(ActiveUserController::class)->group(function () {

    // Userの一覧リストのルート
    Route::get('/all/user', 'AllUser')
      ->name('all-user');

    // Vendorの一覧リストのルート
    Route::get('/all/vendor', 'AllVendor')
      ->name('all-vendor');
  });

  // Blog All Route
  Route::controller(BlogController::class)->group(function () {

    Route::get('/admin/blog/category', 'AllBlogCateogry')
      ->name('admin.blog.category');

    // Blogのカテゴリー追加ページ遷移のルート
    Route::get('/admin/add/blog/category', 'AddBlogCateogry')
      ->name('add.blog.categroy');

    // Blogのカテゴリーの保存処理のルート
    Route::post('/admin/store/blog/category', 'StoreBlogCateogry')
      ->name('store.blog.category');

    // Blogのカテゴリー編集ページ遷移のルート
    Route::get('/admin/edit/blog/category/{id}', 'EditBlogCateogry')
      ->name('edit.blog.category');

    // Blogのカテゴリーの更新処理のルート
    Route::post('/admin/update/blog/category', 'UpdateBlogCateogry')
      ->name('update.blog.category');

    // Blogのカテゴリーの削除処理のルート
    Route::get('/admin/delete/blog/category/{id}', 'DeleteBlogCateogry')
      ->name('delete.blog.category');
  });

  // Blog Post All Route 
  Route::controller(BlogController::class)->group(function () {

    // BlogPostの一覧ページのルート
    Route::get('/admin/blog/post', 'AllBlogPost')
      ->name('admin.blog.post');

    // BlogPostの追加ページ遷移のルート
    Route::get('/admin/add/blog/post', 'AddBlogPost')
      ->name('add.blog.post');

    // BlogPostの保存処理のルート
    Route::post('/admin/store/blog/post', 'StoreBlogPost')
      ->name('store.blog.post');

    // BlogPostの編集ページ遷移のルート
    Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')
      ->name('edit.blog.post');

    // BlogPostの更新処理のルート
    Route::post('/admin/update/blog/post', 'UpdateBlogPost')
      ->name('update.blog.post');

    // BlogPostの削除処理のルート
    Route::get('/admin/delete/blog/post/{id}', 'DeleteBlogPost')
      ->name('delete.blog.post');
  });

  // Site Setting All Route 
  Route::controller(SiteSettingController::class)->group(function () {

    Route::get('/site/setting', 'SiteSetting')
      ->name('site.setting');

    Route::post('/site/setting/update', 'SiteSettingUpdate')
      ->name('site.setting.update');

    Route::get('/seo/setting', 'SeoSetting')
      ->name('seo.setting');

    Route::post('/seo/setting/update', 'SeoSettingUpdate')
      ->name('seo.setting.update');
  });

  // Admin Reviw All Route 
  Route::controller(ReviewController::class)->group(function () {

    Route::get('/pending/review', 'PendingReview')
      ->name('pending.review');

    Route::get('/review/approve/{id}', 'ReviewApprove')
      ->name('review.approve');

    Route::get('/publish/review', 'PublishReview')
      ->name('publish.review');

    Route::get('/review/delete/{id}', 'ReviewDelete')
      ->name('review.delete');
  });

  // Permission All Route 
  Route::controller(RoleController::class)->group(function () {

    // permissonの一覧表示のルート
    Route::get('/all/permission', 'AllPermission')
      ->name('all.permission');

    // permissonの追加ページ遷移のルート
    Route::get('/add/permission', 'AddPermission')
      ->name('add.permission');

    // permissonの保存処理のルート
    Route::post('/store/permission', 'StorePermission')
      ->name('store.permission');

    // permissonの編集ページ遷移のルート
    Route::get('/edit/permission/{id}', 'EditPermission')
      ->name('edit.permission');

    // permissonの更新処理のルート
    Route::post('/update/permission', 'UpdatePermission')
      ->name('update.permission');

    // permissonの削除処理のルート
    Route::get('/delete/permission/{id}', 'DeletePermission')
      ->name('delete.permission');
  });

  // Roles All Route 
  Route::controller(RoleController::class)->group(function () {

    Route::get('/all/roles', 'AllRoles')
      ->name('all.roles');

    Route::get('/add/roles', 'AddRoles')
      ->name('add.roles');

    Route::post('/store/roles', 'StoreRoles')
      ->name('store.roles');

    Route::get('/edit/roles/{id}', 'EditRoles')
      ->name('edit.roles');

    Route::post('/update/roles', 'UpdateRoles')
      ->name('update.roles');

    Route::post('/update/roles', 'UpdateRoles')
      ->name('update.roles');

    Route::get('/delete/roles/{id}', 'DeleteRoles')
      ->name('delete.roles');

    // add role permission 

    Route::get('/add/roles/permission', 'AddRolesPermission')
      ->name('add.roles.permission');

    Route::post('/role/permission/store', 'RolePermissionStore')
      ->name('role.permission.store');

    Route::get('/all/roles/permission', 'AllRolesPermission')
      ->name('all.roles.permission');

    Route::get('/admin/edit/roles/{id}', 'AdminRolesEdit')
      ->name('admin.edit.roles');

    Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')
      ->name('admin.roles.update');

    Route::get('/admin/delete/roles/{id}', 'AdminRolesDelete')
      ->name('admin.delete.roles');
  });

  // Admin User All Route 
  Route::controller(AdminController::class)->group(function () {

    Route::get('/all/admin', 'AllAdmin')
      ->name('all.admin');

    Route::get('/add/admin', 'AddAdmin')
      ->name('add.admin');

    Route::post('/admin/user/store', 'AdminUserStore')
      ->name('admin.user.store');

    Route::get('/edit/admin/role/{id}', 'EditAdminRole')
      ->name('edit.admin.role');

    Route::post('/admin/user/update/{id}', 'AdminUserUpdate')
      ->name('admin.user.update');

    Route::get('/delete/admin/role/{id}', 'DeleteAdminRole')
      ->name('delete.admin.role');
  });
}); // Admin End Middleware 

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

    // VendorProduct:削除処理のルート
    Route::get('/vendor/delete/product/{id}', 'VendorProductDelete')
      ->name('vendor.delete.product');

    // VendorProduct:iactiveのルート
    Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')
      ->name('vendor.product.inactive');

    // VendorProduct:activeのルート
    Route::get('/vendor/product/active/{id}', 'VendorProductActive')
      ->name('vendor.product.active');

    Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
  });

  Route::controller(VendorOrderController::class)->group(function () {
    Route::get('/vendor/order', 'VendorOrder')
      ->name('vendor.order');

    // VendorのProductの一覧リストのルート
    Route::get('/vendor/return/order', 'VendorReturnOrder')
      ->name('vendor.return.order');

    // VendorのProductの返品リストのルート
    Route::get('/vendor/complete/return/order', 'VendorCompleteReturnOrder')
      ->name('vendor.complete.return.order');

    Route::get('/vendor/order/details/{order_id}', 'VendorOrderDetails')
      ->name('vendor.order.details');
  });

  Route::controller(ReviewController::class)->group(function () {

    Route::get('/vendor/all/review', 'VendorAllReview')
      ->name('vendor.all.review');
  });
}); // end Vendor Group middleware

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
Route::get('/', [IndexController::class, 'Index']);

// Shop Page All Route 
Route::controller(ShopController::class)->group(function () {

  Route::get('/shop', 'ShopPage')
    ->name('shop.page');

  Route::post('/shop/filter', 'ShopFilter')
    ->name('shop.filter');
});

// Route::get('/', function () {
//   return view('frontend.index');
// });

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

/// Frontend Product Details All Route 
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Vendorの詳細ページのルート
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])
  ->name('vendor.details');

// Vendorの一覧表示のルート
Route::get('/vendor/all', [IndexController::class, 'VendorAll'])
  ->name('vendor.all');

// CatWiseProductのルート
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);

// SubCatWiseProductのルート
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Product View Modal With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

/// Add to cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

// カート内の商品削除
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

/// Add to cart store data For Product Details Page 
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

/// Add to Compare 
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

/// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])
  ->name('checkout');

// Cart All Route 
Route::controller(CartController::class)->group(function () {
  Route::get('/mycart', 'MyCart')
    ->name('mycart');

  Route::get('/get-cart-product', 'GetCartProduct');
  Route::get('/cart-remove/{rowId}', 'CartRemove');
  Route::get('/cart-increment/{rowId}', 'CartIncrement');
  Route::get('/cart-decrement/{rowId}', 'CartDecrement');
});

// Frontend Blog Post All Route 
Route::controller(ReviewController::class)->group(function () {

  Route::post('/store/review', 'StoreReview')
    ->name('store.review');
});

Route::controller(IndexController::class)->group(function () {

  // Productの検索のルート
  Route::post('/search', 'ProductSearch')
    ->name('product.search');

  Route::post('/search-product', 'SearchProduct');
});

/// User All Route
Route::middleware(['auth', 'role:user'])->group(function () {

  // Wishlist All Route 
  Route::controller(WishlistController::class)->group(function () {

    // WishList:一覧表示のルート
    Route::get('/wishlist', 'AllWishlist')
      ->name('wishlist');

    Route::get('/get-wishlist-product', 'GetWishlistProduct');

    // WishList削除のルート
    Route::get('/wishlist-remove/{id}', 'WishlistRemove');
  });

  // Compare All Route 
  Route::controller(CompareController::class)->group(function () {

    // Compareの一覧表示のルート
    Route::get('/compare', 'AllCompare')
      ->name('compare');

    // GetCompareProductメソッドのajax通信のルート
    Route::get('/get-compare-product', 'GetCompareProduct');

    // compareの削除処理のルート
    Route::get('/compare-remove/{id}', 'CompareRemove');
  });

  // Checkout All Route 
  Route::controller(CheckoutController::class)->group(function () {
    Route::get('/district-get/ajax/{division_id}', 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}', 'StateGetAjax');

    Route::post('/checkout/store', 'CheckoutStore')
      ->name('checkout.store');
  });

  // Stripe All Route 
  Route::controller(StripeController::class)->group(function () {
    // Stripe決済のルート
    Route::post('/stripe/order', 'StripeOrder')
      ->name('stripe.order');

    // 代金引換決済のルート
    Route::post('/cash/order', 'CashOrder')
      ->name('cash.order');
  });

  // User Dashboard All Route 
  Route::controller(AllUserController::class)->group(function () {
    Route::get('/user/account/page', 'UserAccount')
      ->name('user.account.page');

    Route::get('/user/change/password', 'UserChangePassword')
      ->name('user.change.password');

    Route::get('/user/order/page', 'UserOrderPage')
      ->name('user.order.page');

    Route::get('/user/order_details/{order_id}', 'UserOrderDetails');

    Route::get('/user/invoice_download/{order_id}', 'UserOrderInvoice');

    // Prodoctの返品処理のルート
    Route::post('/return/order/{order_id}', 'ReturnOrder')
      ->name('return.order');

    // Productの返品リストページ遷移のルート
    Route::get('/return/order/page', 'ReturnOrderPage')
      ->name('return.order.page');

    // Order Tracking 
    Route::get('/user/track/order', 'UserTrackOrder')
      ->name('user.track.order');

    Route::post('/order/tracking', 'OrderTracking')
      ->name('order.tracking');
  });
  // Frontend Blog Post All Route 
  Route::controller(BlogController::class)->group(function () {

    Route::get('/blog', 'AllBlog')
      ->name('home.blog');

    // Blogの詳細ページ疎通のルート
    Route::get('/post/details/{id}/{slug}', 'BlogDetails');

    Route::get('/post/category/{id}/{slug}', 'BlogPostCategory');
  });
}); // end Usergroup middleware

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
