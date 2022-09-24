<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobType;
class JobTypeController extends Controller
{
    public function index () {
        
        $result = JobType::where("status" , 'A')->orderBy("order_number" , "ASC") ->get();
        if($result){
           foreach ($result as $key => $value) {
               if(isset($_GET['s']) && !empty($_GET['s'])){
                    if($value->id != 4  ){ //4 IS ANY
                        $list[] = array(
                            "job_type" => $value->job_type,
                            "id" => $value->id,
                            "checked" => true
                        );
                    }
               } else{
                    $list[] = array(
                        "job_type" => $value->job_type,
                        "id" => $value->id,

                    );
               }

           }

           return response()->json($list);
        }
    }
}
