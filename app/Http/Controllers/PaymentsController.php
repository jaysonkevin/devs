<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Subscription;
use DB;
class PaymentsController extends Controller
{
    public function checkout(Request $request) 
    {   
        
        # CHECK IF id is on the price table
        $check_price = DB::table("pricing")->where("id" , $request->id)->first();
        if(!$check_price){
            return response()->json([
                "status" => false,
                "message" => "something went wrong!"
            ]);
        }
        // get your logged in customer
        $customer = User::where("id",auth()->user()->id)->first();
     
        // brain tree customer payment nouce
        $payment_method_nonce = $request->nonce;
    
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' =>env('BRAINTREE_PRIVATE_KEY')
        ]);

        // # CHECK IF CUSTOMER HAS ID ON BRAINTREE
        if($customer->braintree_id == null){
            $result = $gateway->customer()->create([
                'firstName' => $customer->firstname,
                'lastName' =>  $customer->lastname,
                'email' =>   $customer->email,
            ]);
            $customer->braintree_id = $result->customer->id;
            $customer->save();
        }

        $res = $gateway->transaction()->sale([
            'amount' => $check_price->price,
            'paymentMethodNonce' => $payment_method_nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($res->success) {

            # ADD SUBSCRIPTION HISTORY
            $subscription = Subscription::create([
                'user_id' => $customer->id,
                "pricing_id" => $check_price->id
            ]);

            # UPDATE BALANCE ON THE USER
            if($customer->balance == null) {
                $last_balance = 0;
            } else{
                $last_balance = $customer->balance;
            }

            if($check_price->id == 1){
                $add_balance = 1; # 1 job post
            } else{
                $add_balance = 5; # 5 job posts
            }

            $new_balance = $last_balance + $add_balance;

            $customer->balance = $new_balance;
            $customer->save();

            return response()->json([
                "status" => true ,
            ]);
        } else{
            return response()->json([
                "status" => false ,
            ]);
        }
    }

    public function upgradeJob (Request $request) {
       
        // get the job data 
        $jobData = Job::where("id" , $request->job_id)->first();

    

        // get your logged in customer
        $customer = User::where("id",auth()->user()->id)->first();
     
        // brain tree customer payment nouce
        $payment_method_nonce = $request->nonce;
    
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' =>env('BRAINTREE_PRIVATE_KEY')
        ]);

        // # CHECK IF CUSTOMER HAS ID ON BRAINTREE
        if($customer->braintree_id == null){
            $result = $gateway->customer()->create([
                'firstName' => $customer->firstname,
                'lastName' =>  $customer->lastname,
                'email' =>   $customer->email,
            ]);
            $customer->braintree_id = $result->customer->id;
            $customer->save();
        }

        $res = $gateway->transaction()->sale([
            'amount' =>29,
            'paymentMethodNonce' => $payment_method_nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($res->success) {

            # CHANGED JOB ID TO PAID 
            $jobData->is_purchased = 'Y';
            $jobData->save();

            # ADD SUBSCRIPTION HISTORY
            $subscription = Subscription::create([
                'user_id' => $customer->id,
                "pricing_id" => 1
            ]);

            return response()->json([
                "status" => true ,
            ]);
        } else{
            return response()->json([
                "status" => false ,
            ]);
        }
    }
}
