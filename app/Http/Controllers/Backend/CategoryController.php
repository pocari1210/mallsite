<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InterventionImage;
use App\Models\Category;

class CategoryController extends Controller
{
  public function AllCategory()
  {

    /****************************************************************
     * 
     * latestメソッドを用いて、Categoryモデルの最新データを
     * $categoriesで取得
     * 
     ***************************************************************/

    $categories = Category::latest()->get();

    return view(
      'backend.category.category_all',
      compact('categories')
    );
  } // End Method 

  public function AddCategory()
  {
    return view('backend.category.category_add');
  } // End Method 

  public function StoreCategory(Request $request)
  {

    /****************************************************************
     * 
     * ★Imageの保存処理★
     * 
     * \backend\category\category_add.blade.phpの
     * formに入力されたname属性category_imageの画像データを
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

    $image = $request->file('category_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(120, 120)->save('storage/upload/category/' . $name_gen);
    $save_url = 'storage/upload/category/' . $name_gen;

    /****************************************************************
     * 
     * ★Categoryモデルにレコード登録★
     * 
     * \backend\category\category_add.blade.phpの
     * フォームに入力された情報を、レコードとし、保存
     * 
     * strtolowerメソッド:
     * 大文字を小文字に変換
     * 
     * str_replaceメソッド:
     * $request->category_nameに
     * 半角スペース(第一引数)があった場合、
     * ハイフン(第二引数)に文字が変更される
     * 
     ***************************************************************/

    Category::insert([
      'category_name' => $request->category_name,
      'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
      'category_image' => $save_url,
    ]);

    $notification = array(
      'message' => 'Category Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.category')->with($notification);
  } // End Method 

  // Categoryの編集のコントローラー
  public function EditCategory($id)
  {
    $category = Category::findOrFail($id);

    return view(
      'backend.category.category_edit',
      compact('category')
    );
  } // End Method 

  // Categoryの更新処理のコントローラー
  public function UpdateCategory(Request $request)
  {

    /***************************************
     * 
     * backend\category\category_edit.blade.phpから情報取得
     * 
     * $request->old_imageで登録済みの画像のデータを取得している
     * 
     ***************************/

    $cat_id = $request->id;
    $old_img = $request->old_image;

    if ($request->file('category_image')) {

      $image = $request->file('category_image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(120, 120)->save('storage/upload/category/' . $name_gen);
      $save_url = 'storage/upload/category/' . $name_gen;

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

      /************************************************
       * 
       * ★updateメソッド★
       * backend\category\category_all.blade.phpの
       * Editボタンを押したid情報($cat_id)を
       * findOrFailで取得し、更新処理を行っている
       * 
       *********************************************/

      Category::findOrFail($cat_id)->update([
        'category_name' => $request->category_name,
        'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        'category_image' => $save_url,
      ]);

      $notification = array(
        'message' => 'Category Updated with image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.category')->with($notification);

      // 画像の更新がない売位の処理
    } else {

      Category::findOrFail($cat_id)->update([
        'category_name' => $request->category_name,
        'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
      ]);

      $notification = array(
        'message' => 'Category Updated without image Successfully',
        'alert-type' => 'success'
      );

      return redirect()->route('all.category')->with($notification);
    } // end else

  } // End Method 

  public function DeleteCategory($id)
  {

    /*************************************************************
     * 
     * backend\category\category_all.blade.phpから
     * deleteボタンを押した$idの情報を
     * findOrFailメソッドで取得。
     * 
     * 現在登録している画像を$imgとし、
     * unlinkメソッドで削除を行う。
     * 
     * Categoryモデルから$idで紐づいたレコードを
     * deleteメソッドで削除している
     * 
     ************************************************************/

    $category = Category::findOrFail($id);
    $img = $category->category_image;
    unlink($img);

    Category::findOrFail($id)->delete();

    $notification = array(
      'message' => 'Category Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
