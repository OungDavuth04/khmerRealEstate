<?php

namespace App\Http\Controllers;

use App\Events\PaymentSummited;
use App\FeaturAd;
use App\Upload;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use http\Env\Response;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
class PaymentCheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $price = 5;
        $pay = '';
        if($request->day == 1){
            $pay =   $price *100;
        }else if($request->day == 2){
            $pay =   $price* 2 *100;
        }else if($request->day == 3){
            $pay =   $price* 3 *100;
        }else if($request->day == 4){
            $pay =   $price* 4 *100;
        }else if($request->day == 5){
            $pay =   $price* 5 *100;
        }else if($request->day == 6){
            $pay =   $price* 6 *100;
        }else if($request->day == 7){
            $pay =   $price* 7 *100;
        }
        Stripe::setApiKey('sk_test_51HehSjAvH7knuOVMLHBUYEvOj2Ud8yiB9h9hB62XSYRG5NtSXlclhBl9CGqGZoKReL2p1EzBDhqnntwMnKj7KUDe00iRI7IeEM');
        $charge = Charge::create(array(
            'amount' =>  $pay,
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'description' => 'Description goes here',
            'receipt_email' => $request->email,
            'metadata' => [
                'data1' => 'metadata 1',
                'data2' => 'metadata 2',
                'data3' => 'metadata 3'
            ] ));
        $uid =  Upload::where('UpId',$request->id)->get();
        foreach ($uid as $id){
            $getid = $id->uid;
        }
        $mutable = Carbon::now();
        $expiredate = $mutable->add($request->day, 'day');
        $expire = FeaturAd::create([
            'UpId' => $request->id,
            'price' => $pay / 100,
            'day' => $request->day ,
            'uid' => $getid,
            'expire' =>$expiredate
        ]);
        return back()->with('success_message', 'Thank you! Your payment has been accepted.');
       // return response()->json($request);

    }
}
