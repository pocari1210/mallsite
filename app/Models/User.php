<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $guarded = [];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // User Active Now 
  public function UserOnline()
  {
    return Cache::has('user-is-online' . $this->id);
  }

  public static function getpermissionGroups()
  {

    // group_nameカラムを指定し、
    // group_nameをグループ化している
    $permission_groups = DB::table('permissions')
      ->select('group_name')->groupBy('group_name')->get();

    return $permission_groups;
  } // End Method 

  public static function getpermissionByGroupName($group_name)
  {
    $permissions =

      // permissionsテーブルを指定
      DB::table('permissions')

      // nameカラムとidカラムを指定
      ->select('name', 'id')

      // group_nameカラムを$group_nameで条件指定
      ->where('group_name', $group_name)
      ->get();
    return $permissions;
  } // End Method 


  // 編集ページ(views\backend\pages\roles\role_permission_edit.blade.php)を
  // 開いた際、登録されている情報にチェックをいれた状態にする
  public static function roleHasPermissions($role, $permissions)
  {
    $hasPermission = true;
    foreach ($permissions as $permission) {

      // $roleに付与されたpermissionをhasPermissionToで指定
      if (!$role->hasPermissionTo($permission->name)) {
        $hasPermission = false;
        return $hasPermission;
      }
      return $hasPermission;
    }
  } // End Method 
}
