<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\VendorApproveNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class AdminController extends Controller
{
  public function AdminDashboard()
  {
    return view('admin.index');
  } // End Mehtod 

  // ★Admin権限のLoginのコントローラー★
  public function AdminLogin()
  {
    return view('admin.admin_login');
  } // End Mehtod 


  /************************************************
    ★Admin権限のLogoutのコントローラー★

    Auth\AuthenticatedSessionController.phpの
    destroyメソッドを参考に記述
   ************************************************/

  public function AdminDestroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
  } // End Mehtod 

  // ★プロフィールページのコントローラー★
  public function AdminProfile()
  {
    // ログインしているユーザーのID情報を取得

    $id = Auth::user()->id;

    // findメソッドでUserモデルの$idを指定し、
    // 該当のレコードを取得

    $adminData = User::find($id);

    return view(
      'admin.admin_profile_view',
      compact('adminData')
    );
  } // End Mehtod

  // ★プロフィール情報更新のコントローラー★
  public function AdminProfileStore(Request $request)
  {

    // ログインしているユーザーのID情報を取得

    $id = Auth::user()->id;

    // findメソッドでUserモデルの$idを指定し、
    // 該当のレコードを取得

    $data = User::find($id);

    /**************************************************
     * views\admin\admin_profile_view.blade.phpの
     * formに入力された情報を取得している。
     * 
     * inputタグのname情報と紐づいている
     ***************************************************/

    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->address = $request->address;

    // formで画像の入力があった場合の処理

    if ($request->file('photo')) {
      $file = $request->file('photo');

      /*******************************************
       * 画像を更新する場合、前に登録していた画像を
       * @unlinkでフォルダから削除する
       * 
       * public_pathメソッドで、
       * publicディレクトリへのパスを取得
       *******************************************/

      @unlink(public_path('upload/admin_images/' . $data->photo));

      // ファイル名を取得

      $filename = date('YmdHi') . $file->getClientOriginalName();

      /*********************************************
       * public_pathで指定したディレクトリに
       * moveメソッドで$filename(画像)を保存している
       *********************************************/

      $file->move(public_path('upload/admin_images'), $filename);

      // photoカラムにレコード追加

      $data['photo'] = $filename;
    }

    // レコードを保存
    $data->save();

    $notification = array(
      'message' => 'Admin Profile Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Mehtod 

  // パスワード変更ページのコントローラー
  public function AdminChangePassword()
  {
    return view('admin.admin_change_password');
  } // End Mehtod 

  // パスワード変更処理のコントローラー
  public function AdminUpdatePassword(Request $request)
  {
    /************************************
     * ★Validationチェック★
     * 
     * required:
     * 入力が必須
     * 
     * confirmed:
     * old_passwordとnew_passwordが
     * 一致しているか確認
     *************************************/

    $request->validate([
      'old_password' => 'required',
      'new_password' => 'required|confirmed',
    ]);

    /*************************************************
     * formに入力されたold_passwordと
     * 登録されたパスワードが異なっていた場合の処理
     ************************************************/

    if (!Hash::check($request->old_password, auth::user()->password)) {
      return back()->with("error", "Old Password Doesn't Match!!");
    }

    // Update The new password 
    User::whereId(auth()->user()->id)->update([
      'password' => Hash::make($request->new_password)

    ]);
    return back()->with("status", " Password Changed Successfully");
  } // End Mehtod

  // InactiveVendor：一覧表示のコントローラー
  public function InactiveVendor()
  {

    /*************************************************
     * Userモデルの
     * statusカラムがinactive、
     * roleカラムがvendorの情報を、条件指定し、
     * latest()で最新の情報を取得している
     ************************************************/

    $inActiveVendor = User::where('status', 'inactive')
      ->where('role', 'vendor')->latest()->get();

    return view(
      'backend.vendor.inactive_vendor',
      compact('inActiveVendor')
    );
  } // End Mehtod 

  public function ActiveVendor()
  {

    /*************************************************
     * Userモデルの
     * statusカラムがactive、
     * roleカラムがvendorの情報を、条件指定し、
     * latest()で最新の情報を取得している
     ************************************************/

    $ActiveVendor = User::where('status', 'active')
      ->where('role', 'vendor')->latest()->get();

    return view(
      'backend.vendor.active_vendor',
      compact('ActiveVendor')
    );
  } // End Mehtod 

  // InactiveVendor：詳細表示のコントローラー
  public function InactiveVendorDetails($id)
  {
    /*************************************************
     * backend\vendor\inactive_vendor.blade.phpから
     * $idの情報をfindOrFailメソッドで取得
     * 
     * データがない場合、エラーを返す。
     ************************************************/

    $inactiveVendorDetails = User::findOrFail($id);

    return view(
      'backend.vendor.inactive_vendor_details',
      compact('inactiveVendorDetails')
    );
  } // End Mehtod 

  public function ActiveVendorDetails($id)
  {

    /*************************************************
     * backend\vendor\active_vendor.blade.phpから
     * $idの情報をfindOrFailメソッドで取得
     * 
     * $idにデータがない場合、エラーを返す。
     ************************************************/

    $activeVendorDetails = User::findOrFail($id);

    return view(
      'backend.vendor.active_vendor_details',
      compact('activeVendorDetails')
    );
  } // End Mehtod 

  // ★ステータス変更のコントローラー★
  public function ActiveVendorApprove(Request $request)
  {
    // formからきたid情報を取得

    $verdor_id = $request->id;

    /*************************************************
     * \backend\vendor\inactive_vendor_details.blade.phpの
     * Active Vendorボタンを押すと、
     * ステータスがactiveに更新される
     ************************************************/

    $user = User::findOrFail($verdor_id)->update([
      'status' => 'active',
    ]);

    $notification = array(
      'message' => 'Vendor Active Successfully',
      'alert-type' => 'success'
    );

    /*************************************************
     * Vendorのステータスがactiveに変更された後、
     * ステータスがActiveになったVendorのダッシュボードに
     * app\Notifications\VendorApproveNotification.phpの
     * toArrayで設定されたメッセージが通知される。
     ************************************************/

    $vuser = User::where('role', 'vendor')->get();
    Notification::send($vuser, new VendorApproveNotification($request));
    return redirect()->route('active.vendor')->with($notification);
  } // End Mehtod 

  public function InActiveVendorApprove(Request $request)
  {

    // formからきたid情報を取得

    $verdor_id = $request->id;

    /*************************************************
     * backend\vendor\active_vendor.blade.phpの
     * Inctive Vendorボタンを押すと、
     * ステータスがInactiveに更新される
     ************************************************/

    $user = User::findOrFail($verdor_id)->update([
      'status' => 'inactive',
    ]);

    $notification = array(
      'message' => 'Vendor InActive Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('inactive.vendor')->with($notification);
  } // End Mehtod 

  ///////////// Admin All Method //////////////

  public function AllAdmin()
  {
    $alladminuser = User::where('role', 'admin')
      ->latest()->get();

    return view(
      'backend.admin.all_admin',
      compact('alladminuser')
    );
  } // End Mehtod 

  public function AddAdmin()
  {
    $roles = Role::all();

    return view(
      'backend.admin.add_admin',
      compact('roles')
    );
  } // End Mehtod 

  public function AdminUserStore(Request $request)
  {

    $user = new User();
    $user->username = $request->username;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->password = Hash::make($request->password);
    $user->role = 'admin';
    $user->status = 'active';
    $user->save();

    if ($request->roles) {
      $user->assignRole($request->roles);
    }

    $notification = array(
      'message' => 'New Admin User Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.admin')->with($notification);
  } // End Mehtod 

  public function EditAdminRole($id)
  {

    $user = User::findOrFail($id);
    $roles = Role::all();
    return view('backend.admin.edit_admin', compact('user', 'roles'));
  } // End Mehtod 

  public function AdminUserUpdate(Request $request, $id)
  {

    $user = User::findOrFail($id);
    $user->username = $request->username;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->role = 'admin';
    $user->status = 'active';
    $user->save();

    $user->roles()->detach();

    if ($request->roles) {
      $user->assignRole($request->roles);
    }

    $notification = array(
      'message' => 'New Admin User Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.admin')->with($notification);
  } // End Mehtod 

  public function DeleteAdminRole($id)
  {

    $user = User::findOrFail($id);
    if (!is_null($user)) {
      $user->delete();
    }

    $notification = array(
      'message' => 'Admin User Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Mehtod 
}
