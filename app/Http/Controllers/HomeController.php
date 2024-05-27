<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;



class HomeController extends Controller
{
  public function home()
  {
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

  public function checkoutpage()
  {
   
  return view('front.checkout');
  }
}
