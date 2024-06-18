<?php

namespace App\Http\Controllers;

use App\Models\SaveCensusFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SquareUpPaymentGateway extends Controller


{

  function cardPayment(Request $request){
    $data=$request->all();
  return view('card-payment',compact('data'));
  }
   

    // EAAAl_QKIALxAV1gYt5cPXQDYuZeL1XWCh3ZBtdOZIWxsda5fYe6Xh_LEG410d2l
    // EAAAl3SphNpun4jg9As1YlFYgS0W20BH22jb3fNIKSS6wwohKwl_f6zJ03gSeLP0

    public function makePayment(Request $request)
    {
        //  echo '<pre>';
        // print_r($request->all());
        // info($request->all());
        // dd($request->all());
        $amount = (float)$request->orderPrice;
        $amount =  $amount * 100;
        $order_id = $request->orderId;
        $idempotencyKey = $request->idempotencyKey;
        $sourceId = $request->sourceId;
        $customer_id = $request->customerId;
        $accessToken =  Config::get('square.sandbox_access_token');
        // EQAAl8_RJFxajo2CFiTc7sSZgbSbezAZo3ncyiHjumdx2GD_s9qjtTt1lKf3f95F refressh token
        $response = Http::withHeaders([

            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
               ])->post('https://connect.squareupsandbox.com/v2/payments', [
            'accept_partial_authorization' => true,
            'idempotency_key' => $idempotencyKey,
            'source_id' => $sourceId,
            'amount_money' => [
                'amount' => $amount,
                'currency' => 'USD',
            ],
            'cash_details' => [
                'buyer_supplied_money' => [
                    'amount' => $amount,
                    'currency' => 'USD',
                ],
            ],
            'customer_id' => $customer_id,
            'customer_details' => [
                'customer_initiated' => true,
                'seller_keyed_in' => true,
            ],
            'billing_address' => [
                'address_line_1' => 'sadfsdf',
                'address_line_2' => 'sadfdsf',
                'address_line_3' => 'adsfsfs',
                'administrative_district_level_1' => 'dsafsfs',
                'administrative_district_level_2' => 'dsfsafsa',
                'administrative_district_level_3' => 'adfdsfa',
                'country' => 'US',
                'first_name' => 'garav',
                'last_name' => 'tha',
                'postal_code' => '96655',
            ],
            'reference_id' => $order_id,
        ]);
       $responseData = $response->json();
 


        if ($responseData['payment']['status'] = 'COMPLETED') {
            $data1 = $responseData['payment'];
            $data1 = $responseData['payment'];
            $updatedData = [];
            $updatedData['payment_id'] = $data1['id'];
            $updatedData['payment_date'] = $data1['created_at'];
            $updatedData['source_type'] = $data1['source_type'];
            $updatedData['payment_order_id'] = $data1['order_id'];
            // $updatedData['receipt_number'] = $data1['receipt_number'];
            // $updatedData['receipt_url'] = $data1['receipt_url'];
            $updatedData['payment_status'] = 'completed';
            // $updatedData['orderPrice'] = $data1['approved_money']['amount'];
            $savedataa  =  SaveCensusFile::where('id', $data1['reference_id'])->where('user_id', $data1['customer_id'])->first();



            SaveCensusFile::where('id', $data1['reference_id'])->where('user_id', $data1['customer_id'])->update($updatedData);
            return response()->json(['message' => 'success', 'data' => $updatedData]);
        } else {
            SaveCensusFile::where('id', $data1['reference_id'])->where('user_id', $data1['customer_id'])->update(['payment_status' => 'failed']);
        }

        echo '<pre>';
        print_r($responseData);
    }
   
}
