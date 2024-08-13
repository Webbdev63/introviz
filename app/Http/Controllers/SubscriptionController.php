<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\SaveCensusFile;
use App\Models\Subscription;
use Auth;

class SubscriptionController extends Controller
{


    public function packagePrice()
    {

        $saveddata = SaveCensusFile::all();
        $subdata = Subscription::all();
       // dd($subdata);
        //echo "<pre>"; print_r($subdata); echo "</pre>";
       // die();
        return view('subscription');
    }

    // public function subscribe(Request $request)
    // {
    //     $user = $request->user();
    //     $now = now();
    
    //     $subscription = Subscription::updateOrCreate(
    //         ['user_id' => $user->id],
    //         [
    //             'amount' => 250,
    //             'currency' => 'USD',
    //             'active' => true,
    //             'starts_at' => $now,
    //             'ends_at' => $now->addMonths(3),
    //         ]
    //     );
    
    //     return response()->json($subscription);
    // }

    // public function subscriptioncheckout()
    // {
    //     return view('subscriptioncheckout');
    // }


    public function subscriptioncheckout(Request $request)
    {
        $data =  $request->all();
        $appId = Config::get('square.sandbox_application_id');
        $locationId = Config::get('square.sandbox_location_id');
            return view('subscriptioncheckout', compact("data", "appId", "locationId"));
    }
    
}
