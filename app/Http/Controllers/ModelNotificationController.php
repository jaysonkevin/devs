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
        $result = ModelNotification::select("user_id")->where("user_id" ,auth()->user()->id)->where("is_seen" ,0)->count();
         return response()->json([
            "status" => true,
            "notif" => $result
        ]); 
    }

    # GET NOTIF LIST FOR MODEL
    public function getNotifListM () {

        $result = ModelNotification::select("user_id","rated_by","is_seen" ,"rating_description","rating","created_at","id")->where("user_id" ,auth()->user()->id)->where("is_seen" ,0)->paginate(1);
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

    public function notification (Request $data) {
        $result = ModelNotification::select("user_id","rated_by","is_seen" ,"rating_description","rating","created_at","id")
                            ->where("id" , $data->id)->where("user_id", $data->user()->id)->first();

                            
        $result->is_seen = 1;
        $result->save();

        $result->rated_date  = date("d-M-Y" , strtotime($result->created_at));
        $result->rated_by_name = EmployerCompany::select("company_display")->where("user_id" , $result->rated_by)->first();


        # GET EMPLOYER IMAGE
        $img = UserImage::select("image")->where("user_id" ,$result->rated_by )->where("is_profile" , 'Y')->where("status" , 'A')->first();
        if($img){
            $folder_name = User::select("folder")->where("id" , $result->rated_by)->first();
            $result->profile_image =  env('APP_URL').'/storage/photo/'.$folder_name->folder.'/'.$img->image.'';
        }  else{
            # ADD IMAGE PLACEHOLDER
            $result->profile_image  = 'https://www.w3schools.com/howto/img_avatar.png';
        }

       

       
        return response()->json([
            "status" => true,
            "data" => $result
        ]); 
    
    }
}
