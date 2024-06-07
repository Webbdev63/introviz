<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Auth;
use App\Models\SaveCensusFile;
use App\Models\City;
use App\Models\CensusFile;
use DB;
use App\Exports\CensusFileExport;
use Maatwebsite\Excel\Facades\Excel;
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
      if ($request['saveRunCount'] == 'YES') {
          $data = Session::get('searchFilter');

          if ($data) {
              $data['fileName'] = $request['fileName'];
              $data['orderPrice'] = $request['totalPrice'];
              $data['user_id'] = 2;
              $data['orderQuantity'] = $request['order_quantity'];
              $data['is_saved'] = 1;

              SaveCensusFile::create($data);
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
      }

      Session::put('searchFilter', $data);

      $criteria = [
          'state' => $data['state'] ?? '',
          'city' => isset($data['city']) && $data['city'] != '' ? explode('-', $data['city'])[1] : '',
          'zip_code' => $data['zip_code'] ?? '',
          'cls' => $data['cls'] ?? '',
          'Carship' => $data['Carship'] ?? '',
          'TOT_PWR_FROM' => $data['selectedRangeFrom'] ?? '',
          'TOT_PWR_TO' => $data['selectedRangeTo'] ?? '',
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
          'Grainfeed' => $data['Grainfeed'] ?? ''
      ];

      $count = CensusFile::filterByCriteria($criteria)->count();
    //echo "<pre>"; print_r($criteria); echo "</pre>";
  //  die();
      return view('result', compact('count', 'filter', 'countFilters', 'criteria'));
  }

    public function export(Request $request)
  {
      $searchCriteria = $request->all();
    //  echo "<pre>"; print_r($searchCriteria); echo "</pre>";
  //    die();
      return Excel::download(new CensusFileExport($searchCriteria), 'census_data.xlsx');
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


}
