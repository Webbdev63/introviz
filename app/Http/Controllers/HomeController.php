<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Auth;
use App\Models\SaveCensusFile;
use App\Models\City;
use App\Models\CensusFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\PhpXlsxGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller

{

    public function home()
    {
            $states = State::all();


 return view('home', compact('states'));

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
      //  echo "<pre>"; print_r($dotNumbers); echo "</pre>";
     //   die();

        if ($insurancedata == 'yes') {

            $filData = DB::table('Census-file')
            ->leftJoin('CENSUS_INS_ACTIVE', 'CENSUS_INS_ACTIVE.DOT_NUMBER', '=', 'Census-file.DOT_NUMBER')
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
                DB::raw('COALESCE(CENSUS_INS_ACTIVE.EFFECTIVE_DATE, "") as `EFFECTIVE DATE`'),
                DB::raw('COALESCE(CENSUS_INS_ACTIVE.NAME_COMPANY, "") as `COMPANY NAME`')

            )
            ->take($data['orderQuantity'])
            ->distinct()
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

            // $filData = DB::table('Census-file')
            //     ->join('CENSUS_INS_ACTIVE', 'CENSUS_INS_ACTIVE.DOT_NUMBER', '=', 'Census-file.DOT_NUMBER')
            //     ->whereIn('Census-file.DOT_NUMBER', $dotNumbers)
            //     ->select(
            //         'Census-file.DOT_NUMBER',
            //         'Census-file.NAME',
            //         'Census-file.NAME_DBA',
            //         'Census-file.PHY_STR',
            //         'Census-file.PHY_CITY',
            //         'Census-file.PHY_ST',
            //         'Census-file.PHY_ZIP',
            //         'Census-file.TEL_NUM',
            //         'Census-file.CARSHIP',
            //         'Census-file.TOT_PWR',
            //         'Census-file.HM_IND',
            //         'Census-file.PASSENGERS',
            //         'Census-file.GENFREIGHT',
            //         'Census-file.HOUSEHOLD',
            //         'Census-file.METALSHEET',
            //         'Census-file.MOTORVEH',
            //         'Census-file.DRIVETOW',
            //         'Census-file.LOGPOLE',
            //         'Census-file.BLDGMAT',
            //         'Census-file.MOBILEHOME',
            //         'Census-file.MACHLRG',
            //         'Census-file.PRODUCE',
            //         'Census-file.OILFIELD',
            //         'Census-file.LIVESTOCK',
            //         'Census-file.COALCOKE',
            //         'Census-file.MEAT',
            //         'Census-file.CHEM',
            //         'Census-file.DRYBULK',
            //         'Census-file.COLDFOOD',
            //         'Census-file.INTERMODAL',
            //         'Census-file.USMAIL',
            //         'Census-file.BEVERAGES',
            //         'Census-file.PAPERPROD',
            //         'Census-file.UTILITY',
            //         'Census-file.FARMSUPP',
            //         'Census-file.CONSTRUCT',
            //         'Census-file.WATERWELL',
            //         'Census-file.CARGOOTHR',
            //         'CENSUS_INS_ACTIVE.EFFECTIVE_DATE',
            //         'CENSUS_INS_ACTIVE.NAME_COMPANY'
            //     )
            //     ->get()
            //     ->map(function ($item) {
            //         return (array) $item;
            //     })
            //     ->toArray();
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

       // echo "<pre>"; print_r($filData); echo "</pre>";
      //  die();
        if(count($filData)>0){
            $header = array_keys($filData[0]);
            array_unshift($filData, $header);
        }
            $xlsx = PhpXlsxGenerator::fromArray($filData);
           // $xlsx->downloadAs('test.xlsx');
            $xlsx->downloadAs($savefilename . '.xlsx');
    }


    public function savedOrder()
    {
        // $totalRecords = CensusFile::count();
        // echo "Total number of records: " . $totalRecords;
        //die();

        $userId = 2;

       $savedData = SaveCensusFile::where('user_id', $userId)->where('payment_status', 'completed')->latest()->first();
        //$savedData = SaveCensusFile::where('user_id', $userId)->get();
        $savedData = SaveCensusFile::where('user_id', $userId)->where('payment_status', 'completed')->get();


        // die();
        return view('front.saved_order', compact('savedData'));
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
        ini_set('max_execution_time', 300);
        $viewName = 'CENSUS';
        if ($request['saveRunCount'] == 'YES') {
            $data = Session::get('searchFilter');
            $TOT_PWR_FROM = $this->getMin($data['TOT_PWR_min']);
            $TOT_PWR_TO = $this->getMax($data['TOT_PWR_max']);

            if ($data) {
                $data = array_merge($data, [
                    'fileName' => $request['fileName'],
                    'orderPrice' => $request['totalPrice'],
                    'user_id' => 2,
                    'orderQuantity' => $request['order_quantity'],
                    'is_saved' => 1,
                    'TOT_PWR_max' => $TOT_PWR_TO,
                    'TOT_PWR_min' => $TOT_PWR_FROM,
                    'Phy_city' => $data['city'],

                ]);
                $data['datatype'] = 'census';
                $saveRecord = SaveCensusFile::create($data);

                if ($saveRecord['id']) {
                    return response()->json(['message' => 'success', 'data' => $saveRecord]);
                }
            } else {
                return response()->json(['message' => 'Please select filter'], 400);
            }
        } else {
            $data = $request->all();
            $appliedFilter = array_filter($data, function ($value) {
                return $value != null;
            });
            unset($appliedFilter["saveRunCount"], $appliedFilter["_token"]);

            $filter = $this->constructFilter($appliedFilter);
            $countFilters = count($appliedFilter);

            Session::put('searchFilter', $data);

            // Extract filter criteria
            $filterCriteria = $this->extractFilterCriteria($data);
            extract($filterCriteria);

            // Fetch filtered data based on criteria
            $filData = CensusFile::filterByCriteria(
                $state, $Phy_city, $zip_code, $cls, $Carship, $TOT_PWR_FROM, $TOT_PWR_TO,
                $Genfreight, $Household, $Metalsheet, $Motorveh, $Drivetow, $Logpole,
                $Bldgmat, $MobileHome, $Machlrg, $Produce, $Liqgas, $Private_passenger,
                $Oilfield, $Livestock, $Coalcoke, $Meat, $Garbage, $Chem, $Drybulk,
                $Coldfood, $Utility, $Intermodal, $Usmail, $Beverages, $Paperprod,
                $Farmsupp, $Construct, $Waterwell, $Cargoother, $Grainfeed, $Hazmat_indicator
            )->pluck('DOT_NUMBER')->toArray();

            if ($insurance_data == 'yes') {

                $filDatawithInsurance = $this->fetchDataWithInsurance($filData);
                $count = count($filDatawithInsurance);
                // echo "<pre>"; print_r($count); echo "</pre>";
              //   echo "<pre>"; print_r($filDatawithInsurance); echo "</pre>"; die();
            } else {
                $censusfilData = CensusFile::filterByCriteria(
                    $state, $Phy_city, $zip_code, $cls, $Carship, $TOT_PWR_FROM, $TOT_PWR_TO,
                    $Genfreight, $Household, $Metalsheet, $Motorveh, $Drivetow, $Logpole,
                    $Bldgmat, $MobileHome, $Machlrg, $Produce, $Liqgas, $Private_passenger,
                    $Oilfield, $Livestock, $Coalcoke, $Meat, $Garbage, $Chem, $Drybulk,
                    $Coldfood, $Utility, $Intermodal, $Usmail, $Beverages, $Paperprod,
                    $Farmsupp, $Construct, $Waterwell, $Cargoother, $Grainfeed, $Hazmat_indicator
                )->get()->toArray();
                  $count = count($censusfilData);
            //     echo "<pre>"; print_r($count); echo "</pre>";
              //   echo "<pre>"; print_r($censusfilData); echo "</pre>"; die();
            }


            //$count = count($filData);
            return view('results', compact('count', 'viewName', 'filter', 'countFilters'));
        }
    }

    private function constructFilter($appliedFilter)
    {
        $filter = '';
        foreach ($appliedFilter as $key => $ap) {
            $key = str_replace(' ', '_', $key);
            switch ($key) {
                case 'city':
                    $cityData = explode("-", $ap);
                    $ap = $cityData[1];
                    break;
                case 'TOT_PWR_min':
                    $key = 'Minimum Power';
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

            $key = str_replace('_', ' ', strtoupper($key));
            $ap = strtoupper($ap);

            if ($ap == 'X' || $key == 'CLS' || $key == 'CARSHIP') {
                $filter .= $key . ', ';
            } else {
                $filter .= $key . '=' . $ap . ', ';
            }
        }
        return $filter;
    }

    private function extractFilterCriteria($data)
    {
        return [
            'insurance_data' => $data['insurance_data'] ?? '',
            'state' => $data['state'] ?? '',
            'Phy_city' => $data['city'] ?? '',
            'zip_code' => $data['Phy_zip'] ?? '',
            'cls' => $data['cls'] ?? '',
            'Carship' => $data['Carship'] ?? '',
            'Private_passenger' => isset($data['Private_passenger']) && $data['Private_passenger'] != 'No' ? 'x' : '',
            'Genfreight' => $data['Genfreight'] ?? '',
            'Household' => $data['Household'] ?? '',
            'Metalsheet' => $data['Metalsheet'] ?? '',
            'Motorveh' => $data['Motorveh'] ?? '',
            'Drivetow' => $data['Drivetow'] ?? '',
            'Logpole' => $data['Logpole'] ?? '',
            'Bldgmat' => $data['Bldgmat'] ?? '',
            'MobileHome' => $data['MobileHome'] ?? '',
            'Machlrg' => $data['Machlrg'] ?? '',
            'Produce' => $data['Produce'] ?? '',
            'Liqgas' => $data['Liqgas'] ?? '',
            'Hazmat_indicator' => $data['Hazmat_indicator'] ?? '',
            'Oilfield' => $data['Oilfield'] ?? '',
            'Livestock' => $data['Livestock'] ?? '',
            'Coalcoke' => $data['Coalcoke'] ?? '',
            'Meat' => $data['Meat'] ?? '',
            'Garbage' => $data['Garbage'] ?? '',
            'Chem' => $data['Chem'] ?? '',
            'Drybulk' => $data['Drybulk'] ?? '',
            'Coldfood' => $data['Coldfood'] ?? '',
            'Utility' => $data['Utility'] ?? '',
            'Intermodal' => $data['Intermodal'] ?? '',
            'Usmail' => $data['Usmail'] ?? '',
            'Beverages' => $data['Beverages'] ?? '',
            'Paperprod' => $data['Paperprod'] ?? '',
            'Farmsupp' => $data['Farmsupp'] ?? '',
            'Construct' => $data['Construct'] ?? '',
            'Waterwell' => $data['Waterwell'] ?? '',
            'Cargoother' => $data['Cargoother'] ?? '',
            'Grainfeed' => $data['Grainfeed'] ?? '',
            'TOT_PWR_FROM' => $this->getMin($data['TOT_PWR_min']),
            'TOT_PWR_TO' => $this->getMax($data['TOT_PWR_max']),
        ];
    }

    private function fetchDataWithInsurance($filData)
    {
        return DB::table('Census-file')
            ->leftJoin('CENSUS_INS_ACTIVE', 'CENSUS_INS_ACTIVE.DOT_NUMBER', '=', 'Census-file.DOT_NUMBER')
            ->whereIn('Census-file.DOT_NUMBER', $filData)
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
                DB::raw('COALESCE(CENSUS_INS_ACTIVE.EFFECTIVE_DATE, "") as `EFFECTIVE DATE`'),
                DB::raw('COALESCE(CENSUS_INS_ACTIVE.NAME_COMPANY, "") as `COMPANY NAME`')

            )
            ->get()
           ->map(function ($item) {
               return (array) $item;
           })
           ->toArray();

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
        return view('front.checkout');
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
            return view('front.checkout', compact("data", "appId", "locationId"));
    }
}
