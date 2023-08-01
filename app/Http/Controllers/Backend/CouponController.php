<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
  public function AllCoupon()
  {
    $coupon = Coupon::latest()->get();

    return view('backend.coupon.coupon_all', compact('coupon'));
  } // End Method 

  // Couponの追加ページ遷移のコントローラー
  public function AddCoupon()
  {
    return view('backend.coupon.coupon_add');
  } // End Method 

  // Couponの保存処理のコントローラー
  public function StoreCoupon(Request $request)
  {
    Coupon::insert([
      'coupon_name' => $request->coupon_name,
      'coupon_discount' => $request->coupon_discount,
      'coupon_validity' => $request->coupon_validity,
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Coupon Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.coupon')->with($notification);
  } // End Method 

  // Couponの編集ページ遷移のコントローラー
  public function EditCoupon($id)
  {
    $coupon = Coupon::findOrFail($id);
    return view('backend.coupon.edit_coupon', compact('coupon'));
  } // End Method 

  // Couponの更新処理のコントローラー
  public function UpdateCoupon(Request $request)
  {
    $coupon_id = $request->id;

    Coupon::findOrFail($coupon_id)->update([
      'coupon_name' => strtoupper($request->coupon_name),
      'coupon_discount' => $request->coupon_discount,
      'coupon_validity' => $request->coupon_validity,
      'created_at' => Carbon::now(),
    ]);

    $notification = array(
      'message' => 'Coupon Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.coupon')->with($notification);
  } // End Method 

  // Couponの削除処理のコントローラー
  public function DeleteCoupon($id)
  {
    Coupon::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Coupon Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
