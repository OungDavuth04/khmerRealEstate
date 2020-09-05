<?php

namespace App\Http\Controllers;

use App\Events\PaymentSummited;
use App\FeaturAd;
use App\Upload;
use http\Env\Response;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
class PaymentCheckoutController extends Controller
{
    public function ggg(Request $request){
        event(new PaymentSummited("Hello"));
    }

    public function getMacAddress(){


        return response()->json(gethostbyaddr($_SERVER['REMOTE_ADDR']));
    }

    public function checkout(Request $request)
    {
        try{
            Stripe::setApiKey(env('STRIPE_SECRET'));
           $charge = Charge::create(array(
               'amount' =>  $request->price*100,
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
             FeaturAd::create([
                'UpId' => $request->id,
                'price' => $request->price,
                'day' => $request->day,
                 'uid' => $getid
            ]);
//            event(new PaymentSummited("Thank For Promote"));

            return back()->with('success_message', 'Thank you! Your payment has been accepted.');
       } catch (\Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
       }

    }
}
