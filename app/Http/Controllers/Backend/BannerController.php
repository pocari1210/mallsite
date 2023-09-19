<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use InterventionImage;

class BannerController extends Controller
{
  public function AllBanner()
  {
    $banner = Banner::latest()->get();

    return view(
      'backend.banner.banner_all',
      compact('banner')
    );
  } // End Method 

  // 新規作成のコントローラー
  public function AddBanner()
  {
    return view('backend.banner.banner_add');
  } // End Method 

  // 保存処理のコントローラー
  public function StoreBanner(Request $request)
  {

    /****************************************************************
     * 
     * ★Imageの保存処理★
     * 
     * \backend\banner\banner_add.blade.phpの
     * formに入力されたname属性banner_imageの画像データを
     * $imageで取得
     * 
     * 作成された画像名を$name_genに挿入
     * 
     * InterventionImage::makeでInterventionImageで画像のサイズを
     * 設定できるようにできる。
     * 、
     * resizeメソッドで横幅(第一引数),縦幅(第二引数)で
     * 画像のサイズを変更。
     * saveメソッドで、指定したディレクトリに画像を格納する
     * 
     * $save_urlに画像のの格納先のpathを挿入
     * 
     ***************************************************************/

    $image = $request->file('banner_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(768, 450)->save('storage/upload/banner/' . $name_gen);
    $save_url = 'storage/upload/banner/' . $name_gen;

    /****************************************************************
     * 
     * ★insertメソッド★
     * 
     * Bannerモデルに\backend\banner\banner_add.blade.phpのformから
     * 送信されてきた情報をレコードとして登録
     * 
     ***************************************************************/

    Banner::insert([
      'banner_title' => $request->banner_title,
      'banner_url' => $request->banner_url,
      'banner_image' => $save_url,
    ]);

    $notification = array(
      'message' => 'Banner Inserted Successfully',
      'alert-type' => 'info'
    );

    return redirect()->route('all.banner')->with($notification);
  } // End Method 

  // 編集ページ疎通のコントローラー
  public function EditBanner($id)
  {

    /****************************************************************
     * 
     * backend\banner\banner_all.blade.phpのEditボタンを押したid情報を
     * findOrFailメソッドで$bannerとして取得している
     * 
     ***************************************************************/

    $banner = Banner::findOrFail($id);

    return view(
      'backend.banner.banner_edit',
      compact('banner')
    );
  } // End Method 

  // 更新処理のコントローラー
  public function UpdateBanner(Request $request)
  {

    /****************************************************************
     * 
     * \backend\banner\banner_edit.blade.phpの
     * inputタグのhiddenのname情報からidと
     * 現在保存している画像(old_image)を取得している
     * 
     ****************************************************************/

    $banner_id = $request->id;
    $old_img = $request->old_image;

    // 画像の更新がある場合の処理
    if ($request->file('banner_image')) {

      $image = $request->file('banner_image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      Image::make($image)->resize(768, 450)->save('storage/upload/banner/' . $name_gen);
      $save_url = 'storage/upload/banner/' . $name_gen;

      /************************************************
       * 
       * ★file_existsメソッド★
       * 引数のファイルがあるか判定を行うメソッド
       * 
       * ★unlinkメソッド★
       * 引数のファイルを削除
       * 
       *********************************************/

      if (file_exists($old_img)) {
        unlink($old_img);
      }

      Banner::findOrFail($banner_id)->update([
        'banner_title' => $request->banner_title,
        'banner_url' => $request->banner_url,
        'banner_image' => $save_url,
      ]);

      $notification = array(
        'message' => 'Banner Updated with image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.banner')->with($notification);

      // 画像の編集がない場合の処理
    } else {

      Banner::findOrFail($banner_id)->update([
        'banner_title' => $request->banner_title,
        'banner_url' => $request->banner_url,
      ]);

      $notification = array(
        'message' => 'Banner Updated without image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.banner')->with($notification);
    } // end else

  } // End Method 

  // 削除処理のコントローラー
  public function DeleteBanner($id)
  {

    /*************************************************************
     * 
     * \backend\banner\banner_all.blade.phpから
     * deleteボタンを押した$idの情報を
     * findOrFailメソッドで取得。
     * 
     * 現在登録している画像を$imgとし、
     * unlinkメソッドで削除を行う。
     * 
     * Bannerモデルから$idで紐づいたレコードを
     * deleteメソッドで削除している
     * 
     ************************************************************/

    $banner = Banner::findOrFail($id);
    $img = $banner->banner_image;
    unlink($img);

    Banner::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Banner Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
