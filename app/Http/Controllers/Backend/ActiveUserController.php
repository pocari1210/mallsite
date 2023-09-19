<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActiveUserController extends Controller
{
  public function AllUser()
  {

    /****************************************************************
     * 
     * Userモデルのroleカラムがuserで登録されている情報を
     * $usersで取得している
     * 
     * latest()で新しい順で表示順設定
     * 
     ***************************************************************/

    $users = User::where('role', 'user')
      ->latest()->get();

    return view(
      'backend.user.user_all_data',
      compact('users')
    );
  } // End Mehtod 

  public function AllVendor()
  {

    /****************************************************************
     * 
     * Userモデルのroleカラムがvendorで登録されている情報を
     * $vendorsで取得している
     * 
     * latest()で新しい順で表示順設定
     * 
     ***************************************************************/

    $vendors = User::where('role', 'vendor')
      ->latest()->get();

    return view(
      'backend.user.vendor_all_data',
      compact('vendors')
    );
  } // End Mehtod 
}
