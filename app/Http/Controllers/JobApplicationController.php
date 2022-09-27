<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\UserImage;
use App\Models\Job; 
use App\Models\AuthChecker;
use App\Models\User;
use DB;
use Carbon\Carbon;
class JobApplicationController extends Controller
{
    public function index (){
        if(auth()->user()->id != null){
            $result = DB::table("job_ads as ja")
                    ->select("ja.accepted_date as created_at","ja.id","jt.id as job_type_id","ja.job_title","ja.job_description","ja.salary","jt.job_type","jap.created_at as date_applied")
                    ->join('job_type as jt', 'jt.id', '=', 'ja.job_type')
                    ->join('job_application as jap', 'jap.job_id', '=', 'ja.id')
                    ->where("jap.user_id" , auth()->user()->id)
                    ->where("ja.status" , 'A')
                    ->where("ja.is_accepted" , 'Y')
                    ->orderBy("ja.id","DESC")->paginate(1);


    foreach ($result as $key => $value) {
        $result[$key]->created_at  = date("d-M-Y" , strtotime($value->created_at));
        $result[$key]->date_applied  = date("d-M-Y" , strtotime($value->date_applied));
    }
    return response()->json($result);
        } else{
            return response()->json([
                "status" => false,
                "message" => "Something went wrong !"
            ]);
        }
    }

    public function newapplicants (Request $request) {
        $result  = DB::table("job_application as jap")
                        ->select("jap.*")
                        ->join("job_ads as ja" , 'ja.id' ,'=' , 'jap.job_id')
                        ->where("ja.status" , 'A')
                        ->where("ja.created_by" ,auth()->user()->id)
                        ->whereNull("jap.employer_notif")->count();

        return response()->json([
            "status" => true,
            "notif" => $result
        ]);
         
    }

    public function newapplicantsList () {

        # GET EACH JOB ON NOTIF TABLE
        $job  = DB::table("job_ads as ja")
                                    ->select("ja.id" , 'ja.job_title' , "jap.created_at")
                                    ->join("job_application as jap"  , 'jap.job_id' ,'=' , 'ja.id')
                                    ->where("created_by" ,auth()->user()->id)
                                    ->whereNull("jap.employer_notif")->orderBy("jap.id" , 'DESC')->groupBy("ja.id")->paginate(5);     
        if($job){
            $notif_array = array();
            foreach ($job as $key => $value) {
                $notif_array[$key]['id']  = $value->id;
                $notif_array[$key]['job_title']  = $value->job_title;
                $notif_array[$key]['applicants'] = JobApplication::where("job_id" , $value->id)->whereNull("employer_notif")->count();  
                $notif_array[$key]['created_at'] =  date("d-M-Y" , strtotime($value->created_at));
               
            }
   
            return response()->json([
                "status" => true,
                "list" => $notif_array ,
                "pagination" => array(
                    "lastPage" => $job->lastPage() , 
                    "currentPage" => $job->currentPage()
                )
            ]);
        } else{
            return response()->json([
                "status" => false
            ]);
        }        
    }

    public function applicants (Request $request){ 

                 
        $job_details = DB::table("job_ads as ja")
                    ->select("ja.job_title","ja.salary","ja.accepted_date","jt.job_type" ,"is_purchased")
                    ->join('job_type as jt', 'jt.id', '=', 'ja.job_type')
                    ->where("ja.created_by" , auth()->user()->id)
                    ->where("ja.id" , $request->job)->first();
        
        # SET SEEN ON ALL 
        if(isset($request->notif)){
            JobApplication::where('job_id', '=',  $request->job)->update(['employer_notif' => 1]);
        }
        
        if($job_details){
            $applicant_lists =  DB::table("job_application as jap")
                                ->select("u.firstname" , "u.lastname" ,"u.country_code","u.folder",'u.id',"is_hired", "rating")
                                ->join("users as u" , 'u.id' , '='  , 'jap.user_id')
                                ->where("jap.job_id" , $request->job)
                                ->orderBy("jap.id",'ASC')
                                ->take(9)
                                ->get();

            foreach ($applicant_lists as $key => $value) {

                # GET PROFILE IMAGE 
                $img = UserImage::select("image")->where("user_id" ,$value->id )->where("is_profile" , 'Y')->where("status" , 'A')->first();
                if($img){
                    $profile_image =  env('APP_URL').'/storage/photo/'.$value->folder.'/'.$img->image.'';
                }  else{
                    # ADD IMAGE PLACEHOLDER
                    $profile_image  = 'https://www.w3schools.com/howto/img_avatar.png';
                }

                $applicant_lists[$key]->profile_image = $profile_image;
            }                   
            return response()->json([
                "job_details" => $job_details ,
                "applicant_lists" => $applicant_lists
            ]);
        } else{
            abort("404");
            die;
        }
    }
    public function applicant (Request $request){

        #CHECK IF BOTH PARAMETERS NEED IS FILLEDOUT
        if( (!isset($request->job) && empty($request->job)) && (!isset($request->applicant) && empty($request->applicant))   ){
            abort( response()->json('Unauthorized', 500) );
            die;
        }

        #CHECK IF JOB IS PURCHASED AND ITS ON THE CORRECT JOB OWNER
        $checkJob = Job::where("id" , $request->job)
                    ->where("created_by", auth()->user()->id)
                    ->where("is_purchased" , 'Y')->first();
        if($checkJob == null){
            abort( response()->json('Unauthorized', 500) );
            die;
        }

        #CHECK IF USER APPLIED ON JOB
        $checkApplicant = JobApplication::where("job_id" , $request->job)->where("user_id" , $request->applicant)->count();
        if($checkApplicant == 0){
            abort( response()->json('Unauthorized', 500) );
            die;
        }


        $userResponse = array();
        $userData = AuthChecker::where("id" ,$request->applicant )->first();
       
        # GET PROFILE IMAGE 
        $img = UserImage::select("image")->where("user_id" ,$request->applicant )->where("is_profile" , 'Y')->where("status" , 'A')->first();
        if($img){
            $profile_image =  env('APP_URL').'/storage/photo/'.$userData->folder.'/'.$img->image.'';
        }  else{
            # ADD IMAGE PLACEHOLDER
             $profile_image  = 'https://www.w3schools.com/howto/img_avatar.png';
        }

        # GET COUNTRY NAME
        $country_name = DB::table("countries")->where("country_code" , $userData->country_code)->first();

        if($userData){
            $userResponse = array(
                "id" => $userData->id,
                "firstname" => $userData->firstname,
                "lastname" => $userData->lastname,
                "date_of_birth" => $userData->date_of_birth,
                "height" => $userData->height,
                "country_code" => $userData->country_code,
                "country_name" => $country_name->country_name,
                "twitter" =>($userData->twitter != null) ? $userData->twitter : 'N/A',
                "facebook" => ($userData->facebook != null) ? $userData->facebook : 'N/A',
                "instagram" => ($userData->instagram != null) ? $userData->instagram : 'N/A',
                "snapchat" => ($userData->snapchat != null) ? $userData->snapchat : 'N/A',
                "linkedin" => ($userData->linkedin != null) ? $userData->linkedin : 'N/A',
                "tiktok" =>  ($userData->tiktok != null) ? $userData->tiktok : 'N/A' ,
                "email" => $userData->email, 
                "profile_image" => $profile_image,
                "age" => Carbon::parse($userData->date_of_birth)->diff( Carbon::now() )->format('%y')
            );
        }
    
        #IMAGE LISTS
        $userImage = UserImage::where("user_id" , $request->applicant)->whereNull("is_profile")->get();
        if($userImage){
           foreach ($userImage as $key => $value) {
              $userImage[$key]->_p_ = $userData->folder;
           }
        }
       
        return response()->json([
            "applicant" => $userResponse ,
            "images" => $userImage
        ]);      
    }
    public function hire(Request $request){
        #CHECK IF ITS YOUR OWN JOB POST
        $check = Job::where("created_by" , auth()->user()->id)->where("id" , $request->job_id)->first();
        if(!$check){
            abort("404");
        }
        
        #CHECK IF USER IS ON JOB ID 
        $result  = JobApplication::where("job_id",$request->job_id)->where("user_id", $request->id)->first();
        if($result){
            $result->is_hired = 'Y';
            $result->save();
        } else{
            abort("404");
        }
       

        return response()->json([
            "status" => true 
        ]);
    }

    public function rateApplicant (Request $request){
        #CHECK IF ITS YOUR OWN JOB POST
        $check = Job::where("created_by" , auth()->user()->id)->where("id" , $request->job_id)->first();
        if(!$check){
            abort("404");
        }
        
        #CHECK IF USER IS ON JOB ID 
        $result  = JobApplication::where("job_id",$request->job_id)->where("user_id", $request->id)->first();
        if($result){
            $result->rating =  $request->rating;
            $result->save();
        } else{
            abort("404");
        }
       

        return response()->json([
            "status" => true 
        ]);
    }
}
