<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
  public function AllSubCategory()
  {
    $subcategories = SubCategory::latest()->get();

    return view(
      'backend.subcategory.subcategory_all',
      compact('subcategories')
    );
  } // End Method 

  // 追加のコントローラー
  public function AddSubCategory()
  {

    /*******************************************************
     * 
     * ★optionグループの並び替え★
     * 
     * orderByメソッドでcategory_nameカラムを軸に、
     * ASCで昇順にしている
     * 
     ******************************************************/

    $categories = Category::orderBy('category_name', 'ASC')->get();

    return view(
      'backend.subcategory.subcategory_add',
      compact('categories')
    );
  } // End Method 

  // 保存処理のコントローラー
  public function StoreSubCategory(Request $request)
  {

    /****************************************************************
     * 
     * ★SubCategoryモデルにレコードの追加★
     * 
     * backend\subcategory\subcategory_add.blade.phpの
     * フォームから入力された情報を保存
     * 
     * strtolowerメソッド:
     * 大文字があった場合、小文字に変換
     * 
     * str_replaceメソッド:
     * $request->subcategory_nameに
     * 半角スペース(第一引数)があった場合、
     * ハイフン(第二引数)に文字が変更される
     * 
     ***************************************************************/

    SubCategory::insert([
      'category_id' => $request->category_id,
      'subcategory_name' => $request->subcategory_name,
      'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
    ]);

    $notification = array(
      'message' => 'SubCategory Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.subcategory')->with($notification);
  } // End Method   

  // 編集のコントローラー
  public function EditSubCategory($id)
  {
    $categories = Category::orderBy('category_name', 'ASC')->get();
    $subcategory = SubCategory::findOrFail($id);

    return view(
      'backend.subcategory.subcategory_edit',
      compact('categories', 'subcategory')
    );
  } // End Method 

  // 更新処理のコントローラー
  public function UpdateSubCategory(Request $request)
  {

    /****************************************************************
     * 
     * \backend\subcategory\subcategory_all.blade.phpの
     * Editボタンのid情報を$subcat_idで受け取る
     * 
     * updateメソッド:
     * 現在登録されている情報を更新する
     * 
     * str_replaceメソッド:
     * $request->subcategory_nameに
     * 半角スペース(第一引数)があった場合、
     * ハイフン(第二引数)に文字が変更される
     * 
     ***************************************************************/

    $subcat_id = $request->id;

    SubCategory::findOrFail($subcat_id)->update([
      'category_id' => $request->category_id,
      'subcategory_name' => $request->subcategory_name,
      'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
    ]);

    $notification = array(
      'message' => 'SubCategory Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.subcategory')->with($notification);
  } // End Method 

  // 削除処理のコントローラー
  public function DeleteSubCategory($id)
  {

    /****************************************************************
     * 
     * \backend\subcategory\subcategory_all.blade.phpの
     * 削除ボタンのidを$idとして扱う
     * 
     * findOrFailで$idと紐づいたレコードを
     * deleteメソッドで削除している
     * 
     ***************************************************************/

    SubCategory::findOrFail($id)->delete();

    $notification = array(
      'message' => 'SubCategory Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method  

  public function GetSubCategory($category_id)
  {

    /****************************************************************
     * 
     * ★Categoryと紐づいたSubCategoryをselectタグに表示★
     * 
     * backend\product\product_add.blade.phpにて使用。
     * Ajax通信を用いて、Categoryと紐づいたSubCategoryを
     * selectで選択できる仕様
     * 
     * SubCategoryモデルのcategory_idカラムを
     * selectタグで選択をした項目のcategory_idで条件指定。
     * 
     * subcategory_nameをASC(昇順)にorderByで並び替え、
     * 取得を行っている。
     * 
     * json_encodeメソッド:
     * 配列をJSONに変換(エンコード)している
     * 
     ***************************************************************/

    $subcat = SubCategory::where('category_id', $category_id)
      ->orderBy('subcategory_name', 'ASC')->get();

    return json_encode($subcat);
  } // End Method 
}
