<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelNotification;
use App\Models\User;
use App\Models\EmployerCompany;
use App\Models\UserImage; 
class ModelNotificationController extends Controller
{   


    public function index() {
        $result = ModelNotification::select("user_id")->where("user_id" ,auth()->user()->id)->count();
         return response()->json([
            "status" => true,
            "notif" => $result
        ]); 
    }

    # GET NOTIF LIST FOR MODEL
    public function getNotifListM () {

        $result = ModelNotification::select("user_id","rated_by","is_seen" ,"rating_description","rating","created_at","id")->where("user_id" ,auth()->user()->id)->paginate(1);
        if( $result ){
            foreach ($result as $key => $value) {
                $result[$key]->created_at_notif  = date("d-M-Y" , strtotime($value->created_at));
                $result[$key]->company_name = EmployerCompany::select("company_display")->where("user_id" , $value->rated_by)->first();
            }     
        } 

        return response()->json([
            "status" => true,
            "notif" => $result
        ]); 
        
    }

    public function getRatingsData (Request $request) {
        $result = ModelNotification::select("user_id","rated_by","is_seen" ,"rating_description","rating","created_at","id")->where("user_id" ,auth()->user()->id)->paginate(5);
        if( $result ){
            foreach ($result as $key => $value) {
                $result[$key]->created_at_notif  = date("d-M-Y" , strtotime($value->created_at));
                $result[$key]->company_name = EmployerCompany::select("company_display")->where("user_id" , $value->rated_by)->first();


                # GET EMPLOYER IMAGE
                $img = UserImage::select("image")->where("user_id" ,$value->rated_by )->where("is_profile" , 'Y')->where("status" , 'A')->first();
                if($img){
                    $folder_name = User::select("folder")->where("id" , $value->rated_by)->first();
                    $result[$key]->profile_image =  env('APP_URL').'/storage/photo/'.$folder_name->folder.'/'.$img->image.'';
                }  else{
                    # ADD IMAGE PLACEHOLDER
                    $result[$key]->profile_image  = 'https://www.w3schools.com/howto/img_avatar.png';
                }
              
            }        
        }

        return response()->json([
            "status" => true,
            "ratings" => $result
        ]); 
        
      

    }
}
