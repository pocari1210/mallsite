<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InterventionImage;
use App\Models\Brand;

class BrandController extends Controller
{
  public function AllBrand()
  {
    $brands = Brand::latest()->get();

    return view(
      'backend.brand.brand_all',
      compact('brands')
    );
  } // End Method 

  // Brand:追加ページのコントローラー
  public function AddBrand()
  {
    return view('backend.brand.brand_add');
  } // End Method 

  // Brand:保存処理のコントローラー
  public function StoreBrand(Request $request)
  {

    /****************************************************************
     * 
     * ★Imageの保存処理★
     * 
     * \backend\brand\brand_add.blade.phpの
     * formに入力されたname属性brand_imageの画像データを
     * $imageで取得
     * 
     * 作成された画像名を$name_genに挿入
     * 
     * InterventionImage::makeでInterventionImageで画像を使えるようにし、
     * resizeメソッドで横幅(第一引数),縦幅(第二引数)で
     * 画像のサイズを変更。
     * saveメソッドで、指定したディレクトリに画像を格納する
     * 
     * $save_urlに画像のの格納先のpathを挿入
     * 
     ***************************************************************/

    $image = $request->file('brand_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(300, 300)->save('storage/upload/brand/' . $name_gen);
    $save_url = 'storage/upload/brand/' . $name_gen;

    /****************************************************************
     * 
     * ★insertメソッド★
     * Brandモデルに\backend\brand\brand_add.blade.phpのformから
     * 送信されてきた情報をレコードとして登録
     * 
     *★strtolowerメソッド★:
     * 大文字を小文字に変換
     * 
     *★str_replaceメソッド★
     * $request->brand_nameに
     * 半角スペース(第一引数)があった場合、
     * ハイフン(第二引数)に文字が変更される
     * 
     ****************************************************************/

    Brand::insert([
      'brand_name' => $request->brand_name,
      'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
      'brand_image' => $save_url,
    ]);

    $notification = array(
      'message' => 'Brand Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.brand')->with($notification);
  } // End Method   

  // Brand:編集処理のコントローラー
  public function EditBrand($id)
  {
    $brand = Brand::findOrFail($id);

    return view(
      'backend.brand.brand_edit',
      compact('brand')
    );
  } // End Method 

  // Brand:更新処理のコントローラー
  public function UpdateBrand(Request $request)
  {

    /****************************************************************
     * 
     *\backend\brand\brand_edit.blade.phpの
     * inputタグのhiddenのname情報からidと
     * 現在保存している画像(old_image)を取得している
     * 
     ****************************************************************/

    $brand_id = $request->id;
    $old_img = $request->old_image;

    // 画像の更新を含めた場合の更新処理
    if ($request->file('brand_image')) {

      $image = $request->file('brand_image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(300, 300)->save('storage/upload/brand/' . $name_gen);
      $save_url = 'storage/upload/brand/' . $name_gen;

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

      Brand::findOrFail($brand_id)->update([
        'brand_name' => $request->brand_name,
        'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
        'brand_image' => $save_url,
      ]);

      $notification = array(
        'message' => 'Brand Updated with image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.brand')->with($notification);
    } else {

      Brand::findOrFail($brand_id)->update([
        'brand_name' => $request->brand_name,
        'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
      ]);

      $notification = array(
        'message' => 'Brand Updated without image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.brand')->with($notification);
    } // end else

  } // End Method 

  // 削除処理のコントローラー
  public function DeleteBrand($id)
  {

    /*************************************************************
     * 
     * \backend\brand\brand_all.blade.phpから
     * deleteボタンを押した$idの情報を
     * findOrFailメソッドで取得。
     * 
     * 現在登録している画像を$imgとし、
     * unlinkメソッドで削除を行う。
     * 
     * Brandモデルから$idで紐づいたレコードを
     * deleteメソッドで削除している
     * 
     ************************************************************/

    $brand = Brand::findOrFail($id);
    $img = $brand->brand_image;
    unlink($img);

    Brand::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Brand Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
