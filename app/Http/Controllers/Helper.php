<?php

namespace App\Http\Controllers;


class Helper {
    
    

    public function honeypot($request){
       
      
        # ANTI BOT HONEY POT
        if(!isset($request->is_valid_)){
            // add data for bot logs
            echo json_encode(["error"=> "Something went wrong!"]);die;
        }
        if(($request->is_valid_) =="true") {
            // add data for bot logs
         
           echo json_encode(["error"=> "Something went wrong!"]);die;
           
        } 
    }
}
