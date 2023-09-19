<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\ShipDivision;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{
  public function AddToCart(Request $request, $id)
  {

    // 商品が新規で追加された際、couponの適応が削除される
    if (Session::has('coupon')) {
      Session::forget('coupon');
    }

    $product = Product::findOrFail($id);

    if ($product->discount_price == NULL) {

      /*********************************************************
       * 
       * ★Cart::add★
       * 
       * カートに追加するときに用いられるメソッド。
       * 配列を用いて、productをカートに追加している。
       * 
       ********************************************************/

      Cart::add([
        'id' => $id,
        'name' => $request->product_name,
        'qty' => $request->quantity,
        'price' => $product->selling_price,
        'weight' => 1,
        'options' => [
          'image' => $product->product_thambnail,
          'color' => $request->color,
          'size' => $request->size,
          'vendor' => $request->vendor,
        ],
      ]);

      return response()->json(['success' => 'Successfully Added on Your Cart']);
    } else {

      Cart::add([
        'id' => $id,
        'name' => $request->product_name,
        'qty' => $request->quantity,
        'price' => $product->discount_price,
        'weight' => 1,
        'options' => [
          'image' => $product->product_thambnail,
          'color' => $request->color,
          'size' => $request->size,
          'vendor' => $request->vendor,
        ],
      ]);

      return response()->json(['success' => 'Successfully Added on Your Cart']);
    }
  } // End Method

  public function AddToCartDetails(Request $request, $id)
  {

    if (Session::has('coupon')) {
      Session::forget('coupon');
    }

    $product = Product::findOrFail($id);

    if ($product->discount_price == NULL) {

      Cart::add([

        'id' => $id,
        'name' => $request->product_name,
        'qty' => $request->quantity,
        'price' => $product->selling_price,
        'weight' => 1,
        'options' => [
          'image' => $product->product_thambnail,
          'color' => $request->color,
          'size' => $request->size,
          'vendor' => $request->vendor,
        ],
      ]);

      return response()->json(['success' => 'Successfully Added on Your Cart']);
    } else {

      Cart::add([
        'id' => $id,
        'name' => $request->product_name,
        'qty' => $request->quantity,
        'price' => $product->discount_price,
        'weight' => 1,
        'options' => [
          'image' => $product->product_thambnail,
          'color' => $request->color,
          'size' => $request->size,
          'vendor' => $request->vendor,
        ],
      ]);

      return response()->json(['success' => 'Successfully Added on Your Cart']);
    }
  } // End Method

  public function AddMiniCart()
  {

    /*****************************************************
     * 
     * ★Cart::content()★
     * Cart::addで取得したデータ情報を受け取っている
     * 
     * ★Cart::count()★
     * カート内の数量を取得している
     * 
     * ★Cart::total()★
     * カートの合計金額を取得
     * 
     ****************************************************/

    $carts = Cart::content();
    $cartQty = Cart::count();
    $cartTotal = Cart::total();

    return response()->json(array(
      'carts' => $carts,
      'cartQty' => $cartQty,
      'cartTotal' => $cartTotal
    ));
  } // End Method

  public function RemoveMiniCart($rowId)
  {

    /*****************************************************************
     * 
     * ★Cart::remove($rowId);★
     * 
     * $rowId(カートに入っているオブジェクトのid)を指定し、
     * カートからproductを削除している
     * 
     *******************************************************************/

    Cart::remove($rowId);
    return response()->json(['success' => 'Product Remove From Cart']);
  } // End Method

  public function MyCart()
  {
    return view('frontend.mycart.view_mycart');
  } // End Method

  public function GetCartProduct()
  {
    $carts = Cart::content();
    $cartQty = Cart::count();
    $cartTotal = Cart::total();

    return response()->json(array(
      'carts' => $carts,
      'cartQty' => $cartQty,
      'cartTotal' => $cartTotal

    ));
  } // End Method

  public function CartRemove($rowId)
  {
    Cart::remove($rowId);

    /*****************************************************************
     * 
     * カートからproductを削除し、couponを使用していた場合の
     * productの合計金額の計算
     * 
     *******************************************************************/

    if (Session::has('coupon')) {
      $coupon_name = Session::get('coupon')['coupon_name'];
      $coupon = Coupon::where('coupon_name', $coupon_name)->first();

      Session::put('coupon', [
        'coupon_name' => $coupon->coupon_name,
        'coupon_discount' => $coupon->coupon_discount,
        'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
        'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
      ]);
    }

    return response()->json(['success' => 'Successfully Remove From Cart']);
  } // End Method

  public function CartIncrement($rowId)
  {

    /*****************************************************************
     * 
     * ★productの個数の増加処理★
     * 
     * ★Cart::get($rowId)★
     * $rowId(idと紐づいたprodct)を指定し、データを取得
     * している
     * 
     * ★Cart::update★
     * 第一引数で$rowIdを指定し、第二引数に更新処理の内容を
     * 記述。(qty(在庫数)を+1している)
     * 
     *******************************************************************/

    $row = Cart::get($rowId);
    Cart::update($rowId, $row->qty + 1);

    if (Session::has('coupon')) {
      $coupon_name = Session::get('coupon')['coupon_name'];
      $coupon = Coupon::where('coupon_name', $coupon_name)->first();

      Session::put('coupon', [
        'coupon_name' => $coupon->coupon_name,
        'coupon_discount' => $coupon->coupon_discount,
        'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
        'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
      ]);
    }

    return response()->json('Increment');
  } // End Method

  public function CartDecrement($rowId)
  {

    /*****************************************************************
     * 
     * ★productの個数の減少処理★
     * 
     * ★Cart::get($rowId)★
     * $rowId(idと紐づいたprodct)を指定し、データを取得
     * している
     * 
     * ★Cart::update★
     * 第一引数で$rowIdを指定し、第二引数に更新処理の内容を
     * 記述。(qty(在庫数)を-1している)
     * 
     *******************************************************************/

    $row = Cart::get($rowId);
    Cart::update($rowId, $row->qty - 1);

    if (Session::has('coupon')) {
      $coupon_name = Session::get('coupon')['coupon_name'];
      $coupon = Coupon::where('coupon_name', $coupon_name)->first();

      Session::put('coupon', [
        'coupon_name' => $coupon->coupon_name,
        'coupon_discount' => $coupon->coupon_discount,
        'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
        'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
      ]);
    }

    return response()->json('Decrement');
  } // End Method

  public function CouponApply(Request $request)
  {

    /*****************************************************************
     * 
     * Couponモデルのcoupon_nameカラムをformから入力した
     * $request->coupon_nameを取得
     * 
     * coupon_validityが現在の時刻(Carbon::now())より未来のものを
     * 条件指定している
     * 
     *******************************************************************/

    $coupon = Coupon::where('coupon_name', $request->coupon_name)
      ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

    // $couponが存在する場合の処理
    if ($coupon) {

      /*****************************************************************
       * 
       * ★Session::put★
       * セッションにkey(coupon): valueを保存。
       * 
       * ※key名のcouponは任意で作成されたもの
       * 
       * ★Cart::total()★
       * カートの合計金額（税込）を取得することができる
       * 
       *******************************************************************/

      Session::put('coupon', [
        'coupon_name' => $coupon->coupon_name,
        'coupon_discount' => $coupon->coupon_discount,
        'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
        'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
      ]);

      // クーポンの適応が成功した時のtoastr
      return response()->json(array(
        'validity' => true,
        'success' => 'Coupon Applied Successfully'
      ));

      // クーポンの適応が失敗した時のtoastr
    } else {
      return response()->json(['error' => 'Invalid Coupon']);
    }
  } // End Method

  public function CouponCalculation()
  {

    if (Session::has('coupon')) {

      /*****************************************************************
       * 
       * ★session()->get('Key')['Value']★
       * 
       * CouponApplyメソッドの
       * Session::putでキーとバリューを取得した情報を取得している
       * 
       *******************************************************************/

      return response()->json(array(
        'subtotal' => Cart::total(),
        'coupon_name' => session()->get('coupon')['coupon_name'],
        'coupon_discount' => session()->get('coupon')['coupon_discount'],
        'discount_amount' => session()->get('coupon')['discount_amount'],
        'total_amount' => session()->get('coupon')['total_amount'],
      ));
    } else {
      return response()->json(array(
        'total' => Cart::total(),
      ));
    }
  } // End Method

  public function CouponRemove()
  {

    /*****************************************************************
     * 
     * ★Session::forget('Key名')★
     * 
     * セッションからcoupon(key) を削除
     * 
     *******************************************************************/

    Session::forget('coupon');
    return response()->json(['success' => 'Coupon Remove Successfully']);
  } // End Method

  public function CheckoutCreate()
  {

    if (Auth::check()) {

      if (Cart::total() > 0) {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();

        return view(
          'frontend.checkout.checkout_view',
          compact('carts', 'cartQty', 'cartTotal', 'divisions')
        );
      } else {

        $notification = array(
          'message' => 'Shopping At list One Product',
          'alert-type' => 'error'
        );

        return redirect()->to('/')->with($notification);
      }
    } else {

      $notification = array(
        'message' => 'You Need to Login First',
        'alert-type' => 'error'
      );

      return redirect()->route('login')->with($notification);
    }
  } // End Method
}
