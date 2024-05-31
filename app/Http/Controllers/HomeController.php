<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\CensusFile;


class HomeController extends Controller
{
  public function home()
  {
   //$totalRecords = CensusFile::count();
   // echo "Total number of records: " . $totalRecords;
 // die();
   $states = State::all();
   //just for test
   //dd($state);
  // die();
   return view('home', compact('states'));
 // return view('home');
  }

  public function getCities(Request $request)
  {
      $state_code = $request->state_code;
     // echo "<pre>"; print_r($state_code); echo "</pre>";
    //  die();
      $cities = City::where('state_code', $state_code)->pluck('city', 'id');
     // echo "<pre>"; print_r($cities); echo "</pre>";
     // die();
      return response()->json($cities);
  }

public function search(Request $request)
  {

    $totalRecords = CensusFile::count();
     //echo "Total number of records: " . $totalRecords;
 //  die();
    // print_r($request->all());
     // die();
      $query = CensusFile::query();

    //   if ($request->filled('state') && $request->state !== 'Select') {
    //     $query->where('PHY_ST', $request->state);
    // }
  
     if ($request->filled('state')) {
         $query->where('PHY_ST', $request->state);
     }
     
    // if ($request->filled('city') && $request->city !== 'city') {
    //     $query->where('PHY_CITY', $request->city);
    // }
      if ($request->filled('city')) {
         $query->where('PHY_CITY', $request->city);
     }
     
    // if ($request->filled('Phy_zip') && $request->Phy_zip !== 'Phy_zip') {
    //     $query->where('PHY_ZIP', $request->Phy_zip);
    // }

      if ($request->filled('Phy_zip')) {
          $query->where('PHY_ZIP', 'like', '%' . $request->Phy_zip . '%');
       //$query->where('PHY_ZIP', $request->Phy_zip);
     }

      $results = $query->get();
      $count = $results->count();

      return view('result', compact('results', 'count'));
  }

  public function checkoutpage()
  {
   
  return view('front.checkout');
  }
}
