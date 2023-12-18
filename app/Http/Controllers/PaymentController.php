<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class PaymentController extends Controller
{
    public function handleCallback(Request $request)
    {
        try {
            $input = $request->all();

            $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
            $saltIndex = 1;

            $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;

            $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
                    ->withHeader('Content-Type:application/json')
                    ->withHeader('accept:application/json')
                    ->withHeader('X-VERIFY:'.$finalXHeader)
                    ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
                    ->get();

          
            $phonePeObject = json_decode($response);

            return view('auth.payment-success',compact('phonePeObject'));


        }catch (\Exception $e) {
              dd($e->getMessage() . '->' . $e->getLine());
        }

    }

    public function phonePePaymentSuccess(){
      
        echo 'success';
        
    }

   
}