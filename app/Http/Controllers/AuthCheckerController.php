<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthChecker;
use Helper;
class AuthCheckerController extends Controller
{
    public function index () {
        if(auth()->user()){
            $result = AuthChecker::where("id" ,auth()->user()->id )->first();
          
            return response()->json([
                "u" => array(
                    "type" => $result->type,
                    "firstname" => $result->firstname,
                    "lastname" => $result->lastname,
                    "date_of_birth" => $result->date_of_birth,
                    "height" => $result->height,
                    "country_code" => $result->country_code,
                    "region" => $result->region,
                    "twitter" =>($result->twitter != null) ? $result->twitter : 'N/A',
                    "facebook" => ($result->facebook != null) ? $result->facebook : 'N/A',
                    "instagram" => ($result->instagram != null) ? $result->instagram : 'N/A',
                    "snapchat" => ($result->snapchat != null) ? $result->snapchat : 'N/A',
                    "linkedin" => ($result->linkedin != null) ? $result->linkedin : 'N/A',
                    "tiktok" =>  ($result->tiktok != null) ? $result->tiktok : 'N/A' ,
                    "user_status" => $result->user_status,
                    "email" => $result->email, 
                )
            ]);
        }
    }

    public function updateinfo (Request $request){
        Helper::honeypot($request); 
        $result = AuthChecker::select("id" , "firstname" , "lastname" , "date_of_birth" , "height" , "country_code" ,"region")->where("id" ,auth()->user()->id )->first();
        
        # update info
        $result->firstname = trim($request->firstname);
        $result->lastname = trim($request->lastname);
        $result->date_of_birth = $request->date_of_birth;
        $result->height = $request->height;
        $result->country_code = $request->country;
        $result->region = $request->region;

      
        $result->save();

        return response()->json([
            "has_error" => false,
            "message" => "success"
        ]);
        
    }

    public function updateinfosocial (Request $request){
        Helper::honeypot($request); 
        $result = AuthChecker::select("id" , "twitter" , "instagram" , "facebook" , "snapchat" , "tiktok")->where("id" ,auth()->user()->id )->first();

           
        # update info
        $result->twitter =  ($request->twitter == 'N/A') ? null : $request->twitter;
        $result->instagram =  ($request->instagram == 'N/A') ? null : $request->instagram;
        $result->facebook =   ($request->facebook == 'N/A') ? null : $request->facebook;
        $result->snapchat = ($request->snapchat == 'N/A') ? null : $request->snapchat;
        $result->tiktok = ($request->tiktok == 'N/A') ? null : $request->tiktok;

     
        $result->save();

        return response()->json([
            "has_error" => false,
            "message" => "success"
        ]);
    }
}
