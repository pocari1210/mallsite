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
    $image = $request->file('brand_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
    $save_url = 'upload/brand/' . $name_gen;

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
    $brand_id = $request->id;
    $old_img = $request->old_image;

    if ($request->file('brand_image')) {

      $image = $request->file('brand_image');
      $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
      InterventionImage::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
      $save_url = 'upload/brand/' . $name_gen;

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
}
