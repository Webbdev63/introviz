<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;



class TestController extends Controller
 {
//   public function home()
//   {
//    $states = State::all();

//    return view('home', compact('states'));

//   }

//   public function getCities(Request $request)
//   {
//       $state_code = $request->state_code;
    
//       $cities = City::where('state_code', $state_code)->pluck('city', 'id');
//      // echo "<pre>"; print_r($cities); echo "</pre>";
//      // die();
//       return response()->json($cities);
//   }

//   public function checkoutpage()
//   {
   
//   return view('front.checkout');
//   }
}
