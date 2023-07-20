<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use InterventionImage;

class ProductController extends Controller
{
  // Productの一覧表示のコントローラー
  public function AllProduct()
  {
    $products = Product::latest()->get();

    return view(
      'backend.product.product_all',
      compact('products')
    );
  } // End Method 

  // Productの追加ページ遷移のコントローラー
  public function AddProduct()
  {
    return view('backend.product.product_add');
  } // End Method 
}
