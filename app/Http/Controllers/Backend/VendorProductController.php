<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use InterventionImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
  public function VendorAllProduct()
  {
    $id = Auth::user()->id;
    $products = Product::where('vendor_id', $id)
      ->latest()->get();

    return view(
      'vendor.backend.product.vendor_product_all',
      compact('products')
    );
  } // End Method 
}
