<?php

namespace App\Http\Controllers;

use App\Models\OutOfServiceModel;
use App\Models\SaveOutofServiceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\PhpXlsxGenerator;
use DB;

class OutOfService extends Controller
{
    public function outOfServiceSearch(Request $request)
    {
      //  dd($request->all());
       // die();

        if ($request['saveRunCount'] == 'YES') {


            $data = Session::get('searchOutOfServiceFilter');

            $appliedFilter = array_filter($data, function ($value) {
                return $value != null;
            });


            if ($data) {

                $data['fileName'] = $request['fileName'];
                $data['orderPrice'] = $request['totalPrice'];
                $data['user_id'] = 2;
                $data['orderQuantity'] = $request['order_quantity'];
                $data['is_saved'] = 1;



           // echo "<pre>"; print_r($data); echo "</pre>";
          //  die();


                $saveRecord = SaveOutofServiceFile::create($data);

                return redirect()->route('checkoutpage');
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

                $filter .= $key . '=' . $ap . ', ';
            }

            $countFilters = count($appliedFilter);

            // $filter = strtoupper(implode(", ", array_keys($appliedFilter)));

            // $appliedFilter=  count($appliedFilter) -2;
        }

        Session::put('searchOutOfServiceFilter', $data);

        $state = isset($data['state']) && $data['state'] != null ? $data['state'] : '';
        $Phy_city = isset($data['city']) && $data['city'] != null ? $data['city'] : '';
        $zip_code = isset($data['zip_code']) && $data['zip_code'] != null ? $data['zip_code'] : '';
        $LEGAL_NAME = isset($data['LEGAL_NAME']) && $data['LEGAL_NAME'] != null ? $data['LEGAL_NAME'] : '';
        $DBA_NAME = isset($data['DBA_NAME']) && $data['DBA_NAME'] != null ? $data['DBA_NAME'] : '';
        $BUS_STREET_PO = isset($data['BUS_STREET_PO']) && $data['BUS_STREET_PO'] != null ? $data['BUS_STREET_PO'] : '';
        $BUS_TELNO = isset($data['BUS_TELNO']) && $data['BUS_TELNO'] != null ? $data['BUS_TELNO'] : '';

        if ($Phy_city != '') {
            $cityState = explode('-', $Phy_city);

            $Phy_city = $cityState[1];
        }
        $filData = OutOfServiceModel::filterOutofService(
            $state,
            $Phy_city,
            $zip_code,
            $LEGAL_NAME,
            $DBA_NAME,
            $BUS_STREET_PO,
            $BUS_TELNO

        )->get()->toArray();

        $count = count($filData);
        $viewName = 'Insurance File';
        return view('insuranceresults', compact('count', 'viewName', 'filter', 'countFilters'));
    }
    public function savedOutofService()
    {
        // $totalRecords = CensusFile::count();
        // echo "Total number of records: " . $totalRecords;
        //die();

        $userId = 2;

        $savedData = SaveOutofServiceFile::where('user_id', $userId)->get();
        // die();
        return view('saved_out_ofService', compact('savedData'));
        // return view('home');
    }
    public function exportServiceFile($id)
    {
        $data = SaveOutofServiceFile::where('id', $id)->first()->toArray();
        $savefilename = $data['fileName'];
       // echo "<pre>"; print_r($data); echo "</pre>"; die();

        $city =  $data['city'] != null ? $data['city'] : '';
        $state =  $data['state'] != null ? $data['state'] : '';

        $zip_code =  $data['zip_code'] != null ? $data['zip_code'] : '';
        $LEGAL_NAME =  $data['LEGAL_NAME'] != null ? $data['LEGAL_NAME'] : '';
        $DBA_NAME =  $data['DBA_NAME'] != null ? $data['DBA_NAME'] : '';
        $BUS_STREET_PO =  $data['BUS_STREET_PO'] != null ? $data['BUS_STREET_PO'] : '';
        $BUS_TELNO =  $data['BUS_TELNO'] != null ? $data['BUS_TELNO'] : '';

        if ($city != '') {
            $cityState = explode('-', $city);

            $Phy_city = $cityState[1];
        }
        else{
            $Phy_city = '';
        }

        $filDataaa = OutOfServiceModel::filterOutofService(
            $state,
            $Phy_city,
            $zip_code,
            $LEGAL_NAME,
            $DBA_NAME,
            $BUS_STREET_PO,
            $BUS_TELNO

        )->take($data['orderQuantity'])->get()->toArray();

        $dotNumbers = array_column($filDataaa, 'DOT_NUMBER');


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
        ->map(function($item) {
            return (array) $item;
        })
        ->toArray();

        if(count($filData)>0){
            $header = array_keys($filData[0]);
            array_unshift($filData, $header);
        }
            $xlsx = PhpXlsxGenerator::fromArray($filData);
            $xlsx->downloadAs($savefilename . '.xlsx');




    }
}
