<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Auth;
use App\Models\SaveCensusFile;
use App\Models\City;
use App\Models\CensusFile;
use DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        // $totalRecords = CensusFile::count();
        // echo "Total number of records: " . $totalRecords;
        //die();
        $states = State::all();

        // die();
        return view('home', compact('states'));
        // return view('home');
    }
    public function savedOrder()
    {
        // $totalRecords = CensusFile::count();
        // echo "Total number of records: " . $totalRecords;
        //die();

        $userId = 2;

        $savedData = SaveCensusFile::where('user_id', $userId)->get();
        // die();
        return view('saved_order', compact('savedData'));
        // return view('home');
    }

    public function getCities(Request $request)
    {
        $state_code = $request->state_code;
        // echo "<pre>"; print_r($state_code); echo "</pre>";
        //  die();
        $cities = City::where('state_code', $state_code)->get(['city', 'state_code', 'id']);
        // info($cities);
        // echo "<pre>"; print_r($cities); echo "</pre>";
        // // die();
        return response()->json($cities);
    }


    public function search(Request $request)
    {

        // DB::connection()->enableQueryLog();

        if ($request['saveRunCount'] == 'YES') {

            $data = Session::get('searchFilter');

            // removed token and flag from array
            $appliedFilter = array_filter($data, function ($value) {
                return $value != null;
            });
            $appliedFilter =  count($appliedFilter) - 2;
            if ($data) {

                $data['fileName'] = $request['fileName'];
                $data['orderPrice'] = $request['totalPrice'];
                $data['user_id'] = 2;
                $data['orderQuantity'] = $request['order_quantity'];
                $data['is_saved'] = 1;

                $saveRecord = SaveCensusFile::create($data);
                return;
            } else {
                echo 'please Select filter';
            }
        } else {
            $data = $request->all();

            $appliedFilter = array_filter($data, function ($value) {

                return $value != null;
            });
            unset($appliedFilter["saveRunCount"]);
            unset($appliedFilter["_token"]);


            $countFilters = count($appliedFilter);

            $filter = strtoupper(implode(", ", array_keys($appliedFilter)));

            // $appliedFilter=  count($appliedFilter) -2;
        }


        Session::put('searchFilter', $data);

        $state = isset($data['state']) && $data['state'] != null ? $data['state'] : '';
        $Phy_city = isset($data['city']) && $data['city'] != null ? $data['city'] : '';
        $zip_code = isset($data['zip_code']) && $data['zip_code'] != null ? $data['zip_code'] : '';
        $cls = isset($data['cls']) && $data['cls'] != null ? $data['cls'] : '';
        $Carship = isset($data['Carship']) && $data['Carship'] != null ? $data['Carship'] : '';
        $TOT_PWR_FROM = isset($data['selectedRangeFrom']) && $data['selectedRangeFrom'] != null ? $data['selectedRangeFrom'] : '';
        $TOT_PWR_TO = isset($data['selectedRangeTo']) && $data['selectedRangeTo'] != null ? $data['selectedRangeTo'] : '';
        $Private_passenger = isset($data['Private_passenger']) && $data['Private_passenger'] != null && $data['Private_passenger'] != 'No' ? 'x' : '';
        $Genfreight = isset($data['Genfreight']) ? $data['Genfreight'] : '';
        $Household = isset($data['Household']) ? $data['Household'] : '';
        $Metalsheet = isset($data['Metalsheet']) ? $data['Metalsheet'] : '';
        $Motorveh = isset($data['Motorveh']) ? $data['Motorveh'] : '';
        $Drivetow = isset($data['Drivetow']) ? $data['Drivetow'] : '';
        $Logpole = isset($data['Logpole']) ? $data['Logpole'] : '';
        $Bldgmat = isset($data['Bldgmat']) ? $data['Bldgmat'] : '';
        $MobileHome = isset($data['MobileHome']) ? $data['MobileHome'] : '';
        $Machlrg = isset($data['Machlrg']) ? $data['Machlrg'] : '';
        $Produce = isset($data['Produce']) ? $data['Produce'] : '';
        $Liqgas = isset($data['Liqgas']) ? $data['Liqgas'] : '';
        $Hazmat_indicator = isset($data['Hazmat_indicator']) && $data['Hazmat_indicator'] != null ? $data['Hazmat_indicator'] : '';
        $Oilfield = isset($data['Oilfield']) ? $data['Oilfield'] : '';
        $Livestock = isset($data['Livestock']) ? $data['Livestock'] : '';
        $Coalcoke = isset($data['Coalcoke']) ? $data['Coalcoke'] : '';
        $Meat = isset($data['Meat']) ? $data['Meat'] : '';
        $Garbage = isset($data['Garbage']) ? $data['Garbage'] : '';
        $Chem = isset($data['Chem']) ? $data['Chem'] : '';
        $Drybulk = isset($data['Drybulk']) ? $data['Drybulk'] : '';
        $Coldfood = isset($data['Coldfood']) ? $data['Coldfood'] : '';
        $Intermodal = isset($data['Intermodal']) ? $data['Intermodal'] : '';
        $Usmail = isset($data['Usmail']) ? $data['Usmail'] : '';
        $Beverages = isset($data['Beverages']) ? $data['Beverages'] : '';
        $Paperprod = isset($data['Paperprod']) ? $data['Paperprod'] : '';
        $Farmsupp = isset($data['Farmsupp']) ? $data['Farmsupp'] : '';
        $Construct = isset($data['Construct']) ? $data['Construct'] : '';
        $Waterwell = isset($data['Waterwell']) ? $data['Waterwell'] : '';
        $Cargoother = isset($data['Cargoother']) ? $data['Cargoother'] : '';
        $Grainfeed = isset($data['Grainfeed']) ? $data['Grainfeed'] : '';

        $Utility = isset($data['Utility']) ? $data['Utility'] : '';
        $Intermodal = isset($data['Intermodal']) ? $data['Intermodal'] : '';

        if ($Phy_city != '') {
            $cityState = explode('-', $Phy_city);

            $Phy_city = $cityState[1];
        }
        $count = CensusFile::filterByCriteria(
            $state,
            $Phy_city,
            $zip_code,
            $cls,
            $Carship,
            $TOT_PWR_FROM,
            $TOT_PWR_TO,
            $Genfreight,
            $Household,
            $Metalsheet,
            $Motorveh,
            $Drivetow,
            $Logpole,
            $Bldgmat,
            $MobileHome,
            $Machlrg,
            $Produce,
            $Liqgas,
            $Private_passenger,
            $Oilfield,
            $Livestock,
            $Coalcoke,
            $Meat,
            $Garbage,
            $Chem,
            $Drybulk,
            $Coldfood,
            $Utility,
            $Intermodal,
            $Usmail,
            $Beverages,
            $Paperprod,
            $Farmsupp,
            $Construct,
            $Waterwell,
            $Cargoother,
            $Grainfeed,
            $Hazmat_indicator
        )->count();


        return view('result', compact('count', 'filter','countFilters'));
    }

    public function checkoutpage()
    {
        return view('front.checkout');
    }
}
