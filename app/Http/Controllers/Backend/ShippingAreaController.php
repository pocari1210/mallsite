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

  // Divisionの編集ページ遷移のコントローラー
  public function EditDivision($id)
  {
    $division = ShipDivision::findOrFail($id);

    return view(
      'backend.ship.division.division_edit',
      compact('division')
    );
  } // End Method 

  // Divisionの更新処理のコントローラー
  public function UpdateDivision(Request $request)
  {
    $division_id = $request->id;

    ShipDivision::findOrFail($division_id)->update([
      'division_name' => $request->division_name,
    ]);

    $notification = array(
      'message' => 'ShipDivision Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.division')->with($notification);
  } // End Method 

  // Divisionの削除処理のコントローラー
  public function DeleteDivision($id)
  {

    ShipDivision::findOrFail($id)->delete();

    $notification = array(
      'message' => 'ShipDivision Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 

  /////////////// District CRUD ///////////////

  // Districtの一覧ページ遷移のコントローラー
  public function AllDistrict()
  {
    $district = ShipDistricts::latest()->get();

    return view(
      'backend.ship.district.district_all',
      compact('district')
    );
  } // End Method 

  // Districtの追加ページ遷移のコントローラー
  public function AddDistrict()
  {
    $division = ShipDivision::orderBy('division_name', 'ASC')->get();

    return view(
      'backend.ship.district.district_add',
      compact('division')
    );
  } // End Method 

  // Districtの保存処理のコントローラー
  public function StoreDistrict(Request $request)
  {
    ShipDistricts::insert([
      'division_id' => $request->division_id,
      'district_name' => $request->district_name,
    ]);

    $notification = array(
      'message' => 'ShipDistricts Inserted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.district')->with($notification);
  } // End Method 

  // Districtの編集処理のコントローラー
  public function EditDistrict($id)
  {
    $division = ShipDivision::orderBy('division_name', 'ASC')->get();
    $district = ShipDistricts::findOrFail($id);
    return view(
      'backend.ship.district.district_edit',
      compact('district', 'division')
    );
  } // End Method 


  // Districtの更新処理のコントローラー
  public function UpdateDistrict(Request $request)
  {
    $district_id = $request->id;

    ShipDistricts::findOrFail($district_id)->update([
      'division_id' => $request->division_id,
      'district_name' => $request->district_name,
    ]);

    $notification = array(
      'message' => 'ShipDistricts Updated Successfully',
      'alert-type' => 'success'
    );

    return redirect()->route('all.district')->with($notification);
  } // End Method 


  // Districtの削除処理のコントローラー
  public function DeleteDistrict($id)
  {
    ShipDistricts::findOrFail($id)->delete();

    $notification = array(
      'message' => 'ShipDistricts Deleted Successfully',
      'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
  } // End Method 
}
