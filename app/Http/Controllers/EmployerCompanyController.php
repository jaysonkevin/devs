<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployerCompany;
use App\Models\User;
use Helper;
class EmployerCompanyController extends Controller
{
    public function updateCompany (Request $data) {

       Helper::honeypot($data); 

       $result = EmployerCompany::where("user_id" , auth()->user()->id)->first();     

       # FOR COMPANY DATA
       $result->company_name = $data['company_name'];
       $result->company_display = $data['company_display'];
       $result->company_description = $data['company_description'];
       $result->company_phone = $data['company_phone'];
       $result->company_address = $data['company_address'];
       $result->save();

       # FOR USERDATA 
       $user = User::where("id" , auth()->user()->id)->first();     
       $user->firstname = $data['firstname'];
       $user->lastname = $data['lastname'];
       $user->country_code = $data['country'];
       //$user->region = $data['region'];
       $user->save();
    }
}
