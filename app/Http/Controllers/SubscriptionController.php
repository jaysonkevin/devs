<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
class SubscriptionController extends Controller
{
    public function index (Request $request) {
    
        $result = Subscription::select("subscription_history.created_at" , "price","name","subscription_history.id")->where("user_id" , auth()->user()->id)
            ->join("pricing as p" , 'p.id' ,'=' ,'pricing_id')
            ->paginate(1);
        

        return response()->json($result);
    }
}
