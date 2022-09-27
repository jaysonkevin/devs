<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthChecker;
use Helper;
use Session;
use Cookie;
use Storage;
use App\Models\UserImage;
use App\Models\EmployerCompany;
use Stevebauman\Location\Facades\Location;

class AuthCheckerController extends Controller
{   


    public function index (Request $request) {
       
        if(auth()->user()){
            $result = AuthChecker::where("id" ,auth()->user()->id )->first();
            
           

            # GET PROFILE IMAGE 
            $img = UserImage::select("image")->where("user_id" ,auth()->user()->id )->where("is_profile" , 'Y')->where("status" , 'A')->first();
            if($img){
                $profile_image =  env('APP_URL').'/storage/photo/'.auth()->user()->folder.'/'.$img->image.'';
            }  else{
                # ADD IMAGE PLACEHOLDER
                 $profile_image  = 'https://www.w3schools.com/howto/img_avatar.png';
            }
            
            if($result->type == 'E'){
                $company = EmployerCompany::where("user_id" ,  $result->id)->first();
                $c = [
                    "company_name" => (isset($company->company_name)) ?  $company->company_name  : '',
                    "company_display" => (isset($company->company_display)) ?  $company->company_display : '',
                    "company_description" =>  (isset($company->company_description)) ? $company->company_description : '',
                    "company_phone"  => (isset($company->company_phone) ) ? $company->company_phone : NULL,
                    "company_address"  => (isset($company->company_address) ) ? $company->company_address : NULL
                ];
            } else{
                $c = [];
            }

          
            return response()->json([
                "u" => array(
                    "id" => $result->id,
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
                    "profile_image" => $profile_image,
                   
                ),
                "c" => $c
            ]);
        }
    }


    public function checker () {
      
        if(auth()->user('santum') == null){
            return response()->json([
                "has_error" => true,
                "message" => "logout"
            ]);
            
        } else{
            return response()->json([
                "has_error" => false,
                "message" => "login"
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

    public function logout (Request $request) {
        $request->user()->tokens()->delete();
    }


    # GET COUTRY AND REGION BY ID
    public function location (){
        
        // Call this dynamically or use 
        // $yourUserIpAddress  =  $_SERVER['REMOTE_ADDR'] but only works in server not in local
        $yourUserIpAddress = '2001:445332:489:ba00:24ba:c59c:8b2e:44f3d';

        $location = Location::get($yourUserIpAddress); 
        if($location->countryName != ""){
            return response()->json([
                "country" =>$location->countryName,
                "country_code" =>$location->countryCode,
                "timezone" => $location->timezone
             ]);
        } else{

            $location = (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$yourUserIpAddress)));

            return response()->json([
                "country" =>$location['geoplugin_countryName'],
                "country_code" =>$location['geoplugin_countryCode'],
                "timezone" => $location['geoplugin_timezone']
            ]);
        }
    }
}
