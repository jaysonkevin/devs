<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Helper;
class ContactUsController extends Controller
{
    public function contact_us(Request $request) {
        
        if(trim($request->email) == ""){
            return response()->json([
                "status" => false,
            ]);
        }

        if(trim($request->fullname) == ""){
            return response()->json([
                "status" => false,
            ]);
        }

        if(trim($request->subject) == ""){
            return response()->json([
                "status" => false,
            ]);
        }
        if(trim($request->message) == ""){
            return response()->json([
                "status" => false,
            ]);
        }


        Helper::honeypot($request); 
        Mail::send([], ['data' => $request], function ($message) use ($request) {
            $message->to('freelance@gmail.com', 'Freelance')->from(trim($request->email),trim($request->fullname))
           ->subject(trim($request->subject)) 
           ->setBody(trim($request->message)); 
        });



        // Mail::send([], [], function () { 
        //     dd($data);
        //     $message->to('freelance@gmail.com', 'Freelance')->from($request->email,$request->fullname)
        //        ->subject($request->subject) 
        //        ->setBody($request->message, 'text/html'); 
        // });
        return response()->json([
            "status" => true,
        ]);
     }
}