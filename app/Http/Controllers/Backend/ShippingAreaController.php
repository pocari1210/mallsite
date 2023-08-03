<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{

  // Divisionの一覧のコントローラー
  public function AllDivision()
  {
    $division = ShipDivision::latest()->get();

    return view(
      'backend.ship.division.division_all',
      compact('division')
    );
  } // End Method 

  // Divisionの追加ページ遷移のコントローラー
  public function AddDivision()
  {
    return view('backend.ship.division.division_add');
  } // End Method 

  // Divisionの保存処理のコントローラー
  public function StoreDivision(Request $request)
  {
    ShipDivision::insert([
      'division_name' => $request->division_name,
    ]);

    $notification = array(
      'message' => 'ShipDivision Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.division')->with($notification);
  } // End Method 
}
