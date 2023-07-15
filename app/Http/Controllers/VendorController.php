<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
  public function VendorDashboard()
  {
    return view('vendor.index');
  } // End Mehtod 

  // ★ログイン処理のコントローラー★
  public function VendorLogin()
  {
    return view('vendor.vendor_login');
  } // End Mehtod 

  // ★ログアウト処理のコントローラー★
  public function VendorDestroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/vendor/login');
  } // End Mehtod 
}
