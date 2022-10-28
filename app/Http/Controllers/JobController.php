<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Country;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use Helper;
use Carbon\Carbon;
use App\Models\User;
class JobController extends Controller
{   
    public function __construct()
    {
       $this->freeLimit = 2;
    }

    public function index (Request $request) {
       
        $result = DB::table("job_ads as ja")->select("ja.created_at","ja.id","jt.id as job_type_id","ja.job_title","ja.job_description","ja.salary","jt.job_type")
                ->join('job_type as jt', 'jt.id', '=', 'ja.job_type')
                ->where("created_by" , auth()->user()->id)
                ->where(function($result) use ($request)  {

                    #CONDITION FOR TITLE
                    if(isset($request->job_title) && !empty($request->job_title)){
                        $result->where("job_title" , 'LIKE', '%'.$request->job_title.'%');
                    }

                    # CONDITION FOR TYPES
                    if(isset($request->job_type) && !empty($request->job_type)){
                        $type = array();
                        foreach ($request->job_type as $key => $value) {
                        
                            $type[] = $value['id'];   
                        }

                        $result->whereIn("ja.job_type" , $type);
                    }
                 })

                ->where("ja.status" , $request->status)
                ->orderBy("ja.id","DESC")->paginate(5);
        foreach ($result as $key => $value) {
            $result[$key]->created_at  = date("d-M-Y" , strtotime($value->created_at));

            # COUNT APPLICANTS PER JOB 
            $result[$key]->applicants = JobApplication::where("job_id" , $value->id)->count();

        }
        return response()->json($result);
    }

    public function addjob (Request $data){
        Helper::honeypot($data); 



        # CHECK IF HAS A PAID BALANCE 
        $employer = User::where("id" , $data->user()->id)->first();
      
        #IF NO BALANCE USE FREE AD JOB
        if($employer->balance <= 0  || $employer->balance == NULL ){
             #CHECK HOW MANY FREE JOB REMAINING
             $checkLimitJobFree = Job::where("created_by", auth()->user()->id)
             ->where("is_purchased" ,'N')
             ->whereBetween("created_at" , [Carbon::today()->startOfDay() , Carbon::today()->endOfDay()] )->count(); 
   
             if($checkLimitJobFree >= $this->freeLimit){
                 return response()->json([
                     "status" => false,
                     "message" => "Free Limit Exceed",
                 ]);
             }
        }

        

        $job = Job::create([
            'created_by' => auth()->user()->id,
            'job_title' => $data['job_title'],
            'job_description' => $data['job_description'],
            'job_type' => $data['job_type'],
            'salary' => $data['salary'],
            'is_purchased' => ($employer->balance > 0) ? 'Y' : 'N' 
        ]);

        if($job->id){
            

            # UPDATE NEW USER BALANCE
            if($employer->balance > 0){
                $employer->balance  = $employer->balance - 1;  
                $employer->save();
            }
            return response()->json([
                "status" => true,
                "message" => "Added"
            ]);
        } else{
            return response()->json([
                "status" => false,
                "message" => "Added",
                "error" => "Something went wrong"
            ]);
        }
    }

    public function editjob (Request $data){
        $result = Job::where("created_by" , auth()->user()->id)->where("id" , $data['_id_'])->first();
        if($result){
            $result->job_type = $data['job_type'];
            $result->job_title = $data['job_title'];
            $result->job_description = $data['job_description'];
            $result->salary = $data['salary'];
            $result->save();

            if($result){
                return response()->json([
                    "status" => true,
                    "message" => "Updated"
                ]);
            } else{
                return response()->json([
                    "status" => false,
                    "message" => "Something went wrong!"
                ]);
            }
        } else{
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!"
            ]);
        }
        
    }

    public function removejob (Request $data) {
        $result = Job::where("created_by" , auth()->user()->id)->where("id" , $data['id'])->first();
        $result->status = 'H';
        $result->save();
        if($result){
            return response()->json([
                "status" => true,
                "message" => "Updated"
            ]);
        } else{
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!"
            ]);
        }
    }

    public function activejobs (Request $request) {
       
        $job_ids = [];
        $request['job_ids'] = $job_ids; 
        if($request->country_code == null && $request->id == null ) {
            $country_code = $request->country_code;
        } else{
            $country_code = $request->country_code;
           
            $job_application = JobApplication::select("job_id")->where("user_id" , $request->id)->get();
            foreach ($job_application as $key => $value) {
                $job_ids[] = $value->job_id;
            }
            $request['job_ids'] =  $job_ids;
        }

        $result = DB::table("job_ads as ja")->select("u.country_code","u.region","u.firstname","u.lastname","ja.created_at","ja.id","jt.id as job_type_id","ja.job_title","ja.job_description","ja.salary","jt.job_type" ,"ja.accepted_date")
                ->join('job_type as jt', 'jt.id', '=', 'ja.job_type')
                ->join('users as u', 'u.id', '=' , 'ja.created_by' )
                ->where(function($result) use ($request)  {
                 
                    #CONDITION FOR JOB IDS OF APPLICATION
                     if( ( count($request->job_ids) > 0) ){
                        $result->whereNotIn("ja.id" , $request->job_ids);
                    }

                    #CONDITION FOR TITLE
                    if( (isset($request->job_title) && !empty($request->job_title)) ){
                        $result->where("job_title" , 'LIKE', '%'.$request->job_title.'%');
                    }
                    # CONDITION FOR TYPES
                    if(isset($request->jobType) && !empty($request->jobType)){
                        $type = array();
                        $type[]  = 4;
                        foreach ($request->jobType as $key => $value) {
                            $type[] = $value;   
                        }
                        $result->whereIn("ja.job_type" , $type);
                    }
                })

                ->where("ja.status" , $request->status)
                ->where("ja.is_accepted" , 'Y')
                ->where("u.country_code" , $country_code)
                ->orderBy("ja.accepted_date","DESC")->paginate(5);
        foreach ($result as $key => $value) {
            $result[$key]->created_at  = date("d-M-Y" , strtotime($value->created_at));
            $result[$key]->accepted_date  = date("d-M-Y" , strtotime($value->accepted_date));
            # GET THE COUNTRY OF EACH JOB
            $result[$key]->country = Country::select("country_name")->where("country_code" , $value->country_code)->first();
    
        }
        return response()->json($result);
    }

    public function job () {
        $result = DB::table("job_ads as ja")->select("ja.created_at","ja.id","jt.id as job_type_id","ja.job_title","ja.job_description","ja.salary","jt.job_type")
        ->join('job_type as jt', 'jt.id', '=', 'ja.job_type')
        ->where("ja.id" , request()->id)
        ->where("ja.status" , 'A')->first();


        $result->created_at  = date("d-M-Y" , strtotime( $result->created_at));
        return response()->json($result);
    }

    public function apply (Request $request) {
      if(auth()->user()->id != null){

        #CHECK IF USER ALREADY APPLIED

        $check = JobApplication::where("job_id" , $request['job_id'])->where("user_id"  , auth()->user()->id)->first();
        if($check == null){
            JobApplication::create([
                "user_id" => auth()->user()->id ,
                "job_id" => $request['job_id']
            ]);

            return response()->json([
                "status" => true,
                "message" => "Goodluck!"
            ]);
        } else{
            return response()->json([
                "status" => false,
                "message" => "Already Applied for this Job!"
            ]);
        }
      
      } else{
        return response()->json([
            "status" => false,
            "message" => "Something went wrong!"
        ]);
      }
    }
}
