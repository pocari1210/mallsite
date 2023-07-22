<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use InterventionImage;

class SliderController extends Controller
{
  public function AllSlider()
  {
    $sliders = Slider::latest()->get();

    return view(
      'backend.slider.slider_all',
      compact('sliders')
    );
  } // End Method 

  // 追加ページ疎通のコントローラー
  public function AddSlider()
  {
    return view('backend.slider.slider_add');
  } // End Method 

  // 保存処理のコントローラー
  public function StoreSlider(Request $request)
  {
    $image = $request->file('slider_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    InterventionImage::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);
    $save_url = 'upload/slider/' . $name_gen;

    Slider::insert([
      'slider_title' => $request->slider_title,
      'short_title' => $request->short_title,
      'slider_image' => $save_url,
    ]);

    $notification = array(
      'message' => 'Slider Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.slider')->with($notification);
  } // End Method 
}
