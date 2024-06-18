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
use Illuminate\Support\Facades\Config;

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
        $data = SaveCensusFile::findOrFail($id)->toArray();
        $savefilename = $data['fileName'];
        $insurancedata = strtolower($data['insurance_data']);
        $city = $data['Phy_city'] ?? '';
        $state = $data['state'] ?? '';
        $zip_code = $data['zip_code'] ?? '';
        $cls = $data['cls'] ?? '';
        $Carship = $data['Carship'] ?? '';

        $fields = [
            'Genfreight', 'Household', 'Metalsheet', 'Motorveh', 'Drivetow', 'Logpole', 'Bldgmat', 'MobileHome',
            'Machlrg', 'Produce', 'Liqgas', 'Private_passenger', 'Oilfield', 'Livestock', 'Coalcoke', 'Meat',
            'Garbage', 'Chem', 'Drybulk', 'Coldfood', 'Utility', 'Intermodal', 'Usmail', 'Beverages', 'Paperprod',
            'Farmsupp', 'Construct', 'Waterwell', 'Cargoother', 'Grainfeed', 'Hazmat_indicator'
        ];

        $conditions = [];
        foreach ($fields as $field) {
            $conditions[$field] = $data[$field] ?? '';
        }

        $TOT_PWR_FROM = $data['TOT_PWR_min'] ?? '';
        $TOT_PWR_TO = $data['TOT_PWR_max'] ?? '';

        if (!empty($city)) {
            $cityState = explode('-', $city);
            $city = $cityState[1] ?? $city;
        }

        $dotNumbers = CensusFile::filterByCriteria(
            $state,
            $city,
            $zip_code,
            $cls,
            $Carship,
            $TOT_PWR_FROM,
            $TOT_PWR_TO,
            $conditions['Genfreight'],
            $conditions['Household'],
            $conditions['Metalsheet'],
            $conditions['Motorveh'],
            $conditions['Drivetow'],
            $conditions['Logpole'],
            $conditions['Bldgmat'],
            $conditions['MobileHome'],
            $conditions['Machlrg'],
            $conditions['Produce'],
            $conditions['Liqgas'],
            $conditions['Private_passenger'],
            $conditions['Oilfield'],
            $conditions['Livestock'],
            $conditions['Coalcoke'],
            $conditions['Meat'],
            $conditions['Garbage'],
            $conditions['Chem'],
            $conditions['Drybulk'],
            $conditions['Coldfood'],
            $conditions['Utility'],
            $conditions['Intermodal'],
            $conditions['Usmail'],
            $conditions['Beverages'],
            $conditions['Paperprod'],
            $conditions['Farmsupp'],
            $conditions['Construct'],
            $conditions['Waterwell'],
            $conditions['Cargoother'],
            $conditions['Grainfeed'],
            $conditions['Hazmat_indicator']
        )->take($data['orderQuantity'])->pluck('DOT_NUMBER')->toArray();

        if ($insurancedata == 'yes') {
            $filData = DB::table('Census-file')
                ->join('CENSUS_INS_ACTIVE', 'CENSUS_INS_ACTIVE.DOT_NUMBER', '=', 'Census-file.DOT_NUMBER')
                ->whereIn('Census-file.DOT_NUMBER', $dotNumbers)
                ->select(
                    'Census-file.DOT_NUMBER',
                    'Census-file.NAME',
                    'Census-file.NAME_DBA',
                    'Census-file.PHY_STR',
                    'Census-file.PHY_CITY',
                    'Census-file.PHY_ST',
                    'Census-file.PHY_ZIP',
                    'Census-file.TEL_NUM',
                    'Census-file.CARSHIP',
                    'Census-file.TOT_PWR',
                    'Census-file.HM_IND',
                    'Census-file.PASSENGERS',
                    'Census-file.GENFREIGHT',
                    'Census-file.HOUSEHOLD',
                    'Census-file.METALSHEET',
                    'Census-file.MOTORVEH',
                    'Census-file.DRIVETOW',
                    'Census-file.LOGPOLE',
                    'Census-file.BLDGMAT',
                    'Census-file.MOBILEHOME',
                    'Census-file.MACHLRG',
                    'Census-file.PRODUCE',
                    'Census-file.OILFIELD',
                    'Census-file.LIVESTOCK',
                    'Census-file.COALCOKE',
                    'Census-file.MEAT',
                    'Census-file.CHEM',
                    'Census-file.DRYBULK',
                    'Census-file.COLDFOOD',
                    'Census-file.INTERMODAL',
                    'Census-file.USMAIL',
                    'Census-file.BEVERAGES',
                    'Census-file.PAPERPROD',
                    'Census-file.UTILITY',
                    'Census-file.FARMSUPP',
                    'Census-file.CONSTRUCT',
                    'Census-file.WATERWELL',
                    'Census-file.CARGOOTHR',
                    'CENSUS_INS_ACTIVE.EFFECTIVE_DATE',
                    'CENSUS_INS_ACTIVE.NAME_COMPANY'
                )
                ->get()
                ->map(function ($item) {
                    return (array) $item;
                })
                ->toArray();
           // echo "<pre>";
           // print_r($filData);
           // echo "</pre>";
           // die();
        } else {
            $filData = CensusFile::filterByCriteria(
                $state,
                $city,
                $zip_code,
                $cls,
                $Carship,
                $TOT_PWR_FROM,
                $TOT_PWR_TO,
                $conditions['Genfreight'],
                $conditions['Household'],
                $conditions['Metalsheet'],
                $conditions['Motorveh'],
                $conditions['Drivetow'],
                $conditions['Logpole'],
                $conditions['Bldgmat'],
                $conditions['MobileHome'],
                $conditions['Machlrg'],
                $conditions['Produce'],
                $conditions['Liqgas'],
                $conditions['Private_passenger'],
                $conditions['Oilfield'],
                $conditions['Livestock'],
                $conditions['Coalcoke'],
                $conditions['Meat'],
                $conditions['Garbage'],
                $conditions['Chem'],
                $conditions['Drybulk'],
                $conditions['Coldfood'],
                $conditions['Utility'],
                $conditions['Intermodal'],
                $conditions['Usmail'],
                $conditions['Beverages'],
                $conditions['Paperprod'],
                $conditions['Farmsupp'],
                $conditions['Construct'],
                $conditions['Waterwell'],
                $conditions['Cargoother'],
                $conditions['Grainfeed'],
                $conditions['Hazmat_indicator']
            )->take($data['orderQuantity'])->get()->toArray();
        }

        if (count($filData) > 0) {
            $header = array_keys($filData[0]);
            array_unshift($filData, $header);
        }

        $xlsx = PhpXlsxGenerator::fromArray($filData);
        $xlsx->downloadAs($savefilename . '.xlsx');
    }



    public function savedOrder()
    {
        // $totalRecords = CensusFile::count();
        // echo "Total number of records: " . $totalRecords;
        //die();

        $userId = 2;

        $savedData = SaveCensusFile::where('user_id', $userId)->where('payment_status', 'completed')->latest()->first();


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
        // echo "<pre>";
        //  print_r($request->all());
        //  die();
        // DB::connection()->enableQueryLog();
        //  $ins_data = ($request['insurance_data']);

        //  if (!empty($request['insurance_data'])){

        //     $ins_data = 'Yes';
        //  } else{
        //      $ins_data = 'No';
        //   }

        //  echo "<pre>";
        //  print_r($ins_data);
        // die();
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
                $data['TOT_PWR_min'] = $TOT_PWR_FROM;
                $data['Phy_city'] = $data['city'];

                // dd($data);
                $saveRecord = SaveCensusFile::create($data);

                if ($saveRecord['id']) {
                    return response()->json(['message' => 'success', 'data' => $saveRecord]);
                }
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
                // if ($key == 'city') {

                //     $cityData = explode("-", $ap);

                //     $ap = $cityData[1];
                // }
                
                // if ($key == 'TOT_PWR_min') {

                //     $key = 'Minimum  Power';

                    
                // }
                // if ($key == 'TOT_PWR_max') {

                //     $key = 'Maximum Power';

                    
                // }
                switch ($key) {
                    case 'city':
                     $cityData = explode("-", $ap);
                      $ap = $cityData[1];
                        break;
                    case 'TOT_PWR_min':
                        $key = 'Minimum  Power';

                        break;
                     case "TOT_PWR_max":
                         $key = 'Maximum Power';
                         break;
                    case 'Bldgmat':
                        $key = 'BUILDING MATERIALS';  
                        break;
                    case 'Machlrg':
                        $key = 'MACHINERY';  
                        break;
                    case 'Chem':
                        $key = 'CHEMICALS';  
                        break;
                    case 'Drivetow':
                        $key = 'DRIVEAWAY / TOWAWAY';  
                        break;
                    case 'Motorveh':
                        $key = 'MOTOR VEHICLES';  
                        break;
                    case 'Logpole':
                        $key = 'LOGS, POLES, BEAMS';  
                        break;
                    case 'Paperprod':
                        $key = 'PAPER PRODUCTS';  
                        break;
                    case 'cls':
                   
                        
                        break;
                    
                    
                }
         
                $key = str_replace('_', '  ', strtoupper($key));

                $ap = strtoupper($ap);
                if ($ap == 'X' || $key== 'CLS' || $key== 'CARSHIP' ) {
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
        $insurance_data = isset($data['insurance_data']) && $data['insurance_data'] != null ? $data['insurance_data'] : '';
        $state = isset($data['state']) && $data['state'] != null ? $data['state'] : '';
        $Phy_city = isset($data['city']) && $data['city'] != null ? $data['city'] : '';
        $zip_code = isset($data['Phy_zip']) && $data['Phy_zip'] != null ? $data['Phy_zip'] : '';
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
        //   echo "<pre>"; print_r($data); echo "</pre>";

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

        // echo "<pre>"; print_r($filData); echo "</pre>";
        // die();

        $count = count($filData);


        $viewName = 'CENSUS';
        return view('results', compact('count', 'viewName', 'filter', 'countFilters'));
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

    public function processPayment(Request $request)
    {
        $data =  $request->all();
        $appId = Config::get('square.sandbox_application_id');
        $locationId = Config::get('square.sandbox_location_id');
        return view('checkout', compact("data", "appId", "locationId"));
    }

    public function Userlogin()
    {
        
        return view('user_login',);
    }
    public function userRegister()
    {
        
        return view('user_register');
    }
    
}
