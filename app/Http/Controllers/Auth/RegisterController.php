<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\Country;
use App\Models\EmployerCompany;
use File;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $data)
    {
        // return Validator::make($data, [
        //     'firstname' => ['required', 'string', 'max:255'],
        //     'lastname' => ['required', 'string', 'max:255'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'country_code' => ['required', 'string', 'max:3'],
        // ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $data)
    {   


       
        $this->registerValidation($data);

        $folder = str_replace(' ', '', strtolower(time().'-'.substr(Hash::make($data['password']), -4))); 
       
       
       
        $user =  User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'], 
            'country_code' => $data['country_code'] ,
            'folder' => ''
            
        ]);


        $user = User::where('id' , $user->id)->first();
        $user->folder = $user->id.$folder;
        $user->save();


        # CREATE FOLDER
        $path = storage_path('photo/'.$user->folder);
        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        # ADD COMPANY DETAILS
        if($data['type'] == 'E') {
            EmployerCompany::create([
                'user_id' => $user->id,
                'company_name' => $data['companyName'] ,
                'company_display' => $data['companyDisplay'],
                'company_description' => $data['company_description'] 
            ]);
        }


        # CREATE FOLDER
        $path = public_path('photo/'.$folder);
        if(!File::exists($path)) {
            // path does not exist
        }

        event(new Registered($user));

       
    }

    private function registerValidation ($data){

      
        # CHECK IF COUNTRY CODE IS ON LIST
        $checkList = Country::where("country_code", $data['country_code'])->get();
       
        if(!$checkList){
            echo json_encode(

                array(
                    "has_error" => true ,
                    "message" => "Something went wrong!"
                )
            );die;
        }

        $result = User::where("email" , $data['email'])->first();
        if($result){
            echo json_encode(

                array(
                    "has_error" => true ,
                    "message" => "Email already in used!"
                )
            );die;
        }

        # PASSWORD VALIDATION
        if(strlen($data['password']) < 6) {
            echo json_encode(
                array(
                    "has_error" => true ,
                    "message" => "password must be at least 6 characters!"
                )
            );die;
        }
    }
}
