<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Auth;
use App\Models\SaveCensusFile;
use App\Models\City;
use App\Models\CensusFile;
use DB;
use App\PhpXlsxGenerator;
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
    public function exportToExcel($id)
    {
        $data = SaveCensusFile::where('id', $id)->first()->toArray();

        $city =  $data['Phy_city'] != null ? $data['Phy_city'] : '';
        $state =  $data['state'] != null ? $data['state'] : '';
        $Phy_city =  $data['Phy_city'] != null ? $data['Phy_city'] : '';
        $zip_code =  $data['zip_code'] != null ? $data['zip_code'] : '';
        $cls =  $data['cls'] != null ? $data['cls'] : '';
        $Carship =  $data['Carship'] != null ? $data['Carship'] : '';

        $Private_passenger = $data['Private_passenger'] != null && $data['Private_passenger'] != 'No' ? 'x' : '';
        $Genfreight = $data['Genfreight'] != null  ? $data['Genfreight'] : '';
        $Household =$data['Household'] != null  ? $data['Household'] : '';
        $Metalsheet =  $data['Metalsheet'] != null ? $data['Metalsheet'] : '';
        $Motorveh = $data['Motorveh'] != null  ? $data['Motorveh'] : '';
        $Drivetow = $data['Drivetow'] != null  ? $data['Drivetow'] : '';
        $Logpole = $data['Logpole'] != null ? $data['Logpole'] : '';
        $Bldgmat = $data['Bldgmat'] != null  ? $data['Bldgmat'] : '';
        $MobileHome =  $data['MobileHome'] != null ? $data['MobileHome'] : '';
        $Machlrg = $data['Machlrg'] != null  ? $data['Machlrg'] : '';
        $Produce = $data['Produce'] != null  ? $data['Produce'] : '';
        $Liqgas = $data['Liqgas'] != null ? $data['Liqgas'] : '';
        $Hazmat_indicator =  $data['Hazmat_indicator'] != null ? $data['Hazmat_indicator'] : '';
        $Oilfield =  $data['Oilfield'] != null ? $data['Oilfield'] : '';
        $Livestock =  $data['Livestock'] != null ? $data['Livestock'] : '';
        $Coalcoke = $data['Coalcoke'] != null  ? $data['Coalcoke'] : '';
        $Meat =  $data['Meat'] != null ? $data['Meat'] : '';
        $Garbage =  $data['Garbage'] != null ? $data['Garbage'] : '';
        $Chem =  $data['Chem'] != null  ? $data['Chem'] : '';
        $Drybulk =  $data['Drybulk'] != null ? $data['Drybulk'] : '';
        $Coldfood =  $data['Coldfood'] != null  ? $data['Coldfood'] : '';
        $Intermodal =  $data['Intermodal'] != null  ? $data['Intermodal'] : '';
        $Usmail =  $data['Usmail'] != null  ? $data['Usmail'] : '';
        $Beverages =$data['Beverages'] != null  ? $data['Beverages'] : '';
        $Paperprod =  $data['Paperprod'] != null ? $data['Paperprod'] : '';
        $Farmsupp =  $data['Farmsupp'] != null  ? $data['Farmsupp'] : '';
        $Construct =  $data['Construct'] != null ? $data['Construct'] : '';
        $Waterwell =  $data['Waterwell'] != null ? $data['Waterwell'] : '';
        $Cargoother =  $data['Cargoother'] != null  ? $data['Cargoother'] : '';
        $Grainfeed =  $data['Grainfeed'] != null  ? $data['Grainfeed'] : '';

        $Utility =  $data['Utility'] != null ? $data['Utility'] : '';
        $Intermodal =  $data['Intermodal'] != null  ? $data['Intermodal'] : '';

        $TOT_PWR_FROM = $data['TOT_PWR_min'] != null  ? $data['TOT_PWR_min'] : '';

        $TOT_PWR_TO =   $data['TOT_PWR_max'] != null  ? $data['TOT_PWR_max'] : '';

        if ($Phy_city != '') {
            $cityState = explode('-', $Phy_city);

            $Phy_city = $cityState[1];
        }

        $filData = CensusFile::filterByCriteria(
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
        )->take($data['orderQuantity'])->get()->toArray();

        if(count($filData)>0){
            $header = array_keys($filData[0]);
            array_unshift($filData, $header);
        }
            $xlsx = PhpXlsxGenerator::fromArray($filData);
            $xlsx->downloadAs('test.xlsx');




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
            $TOT_PWR_FROM = $this->getMin($data['TOT_PWR_min']);

            $TOT_PWR_TO =    $this->getMax($data['TOT_PWR_max']);
            if ($data) {

                $data['fileName'] = $request['fileName'];
                $data['orderPrice'] = $request['totalPrice'];
                $data['user_id'] = 2;
                $data['orderQuantity'] = $request['order_quantity'];
                $data['is_saved'] = 1;


                $data['TOT_PWR_max'] = $TOT_PWR_TO;
                $data['TOT_PWR_min'] = $TOT_PWR_FROM ;
                $data['Phy_city'] =$data['city'];

// dd($data);
                $saveRecord = SaveCensusFile::create($data);

                return response()->json(['message'=>'sucess']);
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

            $filter = '';
            foreach ($appliedFilter as $key => $ap) {
                $key = str_replace(' ', '_', $key);
                if ($key == 'city') {

                    $cityData = explode("-", $ap);

                    $ap = $cityData[1];
                }
                $key = str_replace('_', '  ', strtoupper($key));

                $ap = strtoupper($ap);
                if ($ap == 'X') {
                    $filter .= $key  . ', ';
                } else {
                    $filter .= $key . '=' . $ap . ', ';
                }
            }

            $countFilters = count($appliedFilter);

            // $filter = strtoupper(implode(", ", array_keys($appliedFilter)));

            // $appliedFilter=  count($appliedFilter) -2;
        }

        Session::put('searchFilter', $data);

        $state = isset($data['state']) && $data['state'] != null ? $data['state'] : '';
        $Phy_city = isset($data['city']) && $data['city'] != null ? $data['city'] : '';
        $zip_code = isset($data['zip_code']) && $data['zip_code'] != null ? $data['zip_code'] : '';
        $cls = isset($data['cls']) && $data['cls'] != null ? $data['cls'] : '';
        $Carship = isset($data['Carship']) && $data['Carship'] != null ? $data['Carship'] : '';
        $Carship = isset($data['Carship']) && $data['Carship'] != null ? $data['Carship'] : '';
        $Carship = isset($data['Carship']) && $data['Carship'] != null ? $data['Carship'] : '';

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

        $TOT_PWR_FROM = $this->getMin($data['TOT_PWR_min']);

        $TOT_PWR_TO =    $this->getMax($data['TOT_PWR_max']);
        if ($Phy_city != '') {
            $cityState = explode('-', $Phy_city);

            $Phy_city = $cityState[1];
        }
        $filData = CensusFile::filterByCriteria(
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
        )->get()->toArray();

        $count = count($filData);


        $viewName='CENSUS';
        return view('results', compact('count','viewName', 'filter', 'countFilters'));
    }



    function  getMin($vl)
    {
        switch ($vl) {
            case 1:
                return 1;
                break;
            case 2:
                return 10;
                break;
            case 3:
                return 100;
                break;
            case 4:
                return 1000;
                break;
            case 5:
                return 10000;
                break;
            case 6:
                return 100000;
                break;
            case 7:
                return 1000000;
                break;
            case 8:
                return 10000000;
                break;
        }
    }
    function  getMax($vl)
    {
        switch ($vl) {
            case 1:
                return 9;
                break;
            case 2:
                return 99;
                break;
            case 3:
                return 999;
                break;
            case 4:
                return 9999;
                break;
            case 5:
                return 99999;
                break;
            case 6:
                return 999999;
                break;
            case 7:
                return 9999999;
                break;
            case 8:
                return 99999999;
                break;
        }
    }


    public function checkoutpage()
    {
        return view('checkout');
    }

    public function Outofservicefile()
    {
        $states = State::all();
        return view('Outofservicefile', compact('states'));
    }

    public function InsuranceFile()
    {
        $states = State::all();
        return view('InsuranceFile', compact('states'));
    }




}
