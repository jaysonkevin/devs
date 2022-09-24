<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\UserImage;
use App\Models\Job;
use DB;
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
                                    ->whereNull("jap.employer_notif")->orderBy("jap.id" , 'DESC')->groupBy("ja.id")->paginate(2);     
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
                                ->select("u.firstname" , "u.lastname" ,"u.country_code","u.folder",'u.id')
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
        }
    }
}
