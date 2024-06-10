<?php

namespace App\Http\Controllers;

use App\Models\OutOfServiceModel;
use App\Models\SaveOutofServiceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\PhpXlsxGenerator;

class OutOfService extends Controller
{
    public function outOfServiceSearch(Request $request)
    {
        // dd($request->all());

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
        $viewName = 'Out Of Service';
        return view('search.results', compact('count', 'viewName', 'filter', 'countFilters'));
    }
    public function savedOutofService()
    {
        // $totalRecords = CensusFile::count();
        // echo "Total number of records: " . $totalRecords;
        //die();

        $userId = 2;

        $savedData = SaveOutofServiceFile::where('user_id', $userId)->get();
        // die();
        return view('front.saved_out_ofService', compact('savedData'));
        // return view('home');
    }
    public function exportServiceFile($id)
    {
        $data = SaveOutofServiceFile::where('id', $id)->first()->toArray();

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

        $filData = OutOfServiceModel::filterOutofService(
            $state,
            $Phy_city,
            $zip_code,
            $LEGAL_NAME,
            $DBA_NAME,
            $BUS_STREET_PO,
            $BUS_TELNO

        )->take($data['orderQuantity'])->get()->toArray();

        if(count($filData)>0){
            $header = array_keys($filData[0]);
            array_unshift($filData, $header);
        }
            $xlsx = PhpXlsxGenerator::fromArray($filData);
            $xlsx->downloadAs('test.xlsx');




    }
}
