<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#PUBLIC ROUTES

Route::post('login')->name('login.attempt')->uses('Auth\LoginController@login');
Route::get('/email/verify/{id}/{hash}',function($request){
    $user = User::where("id", $request)->first();

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        
        event(new Verified($user));
        if($user->type =="M"){
            return redirect('model/login');
        } else{
            return redirect('employer/login');
        }
    }
});

Route::get("forgotpassword", function(){
    return view('index');
});

Route::get("reset/{token}/{email}" , function($token , $email){   
    return view('index');
});

Route::get('password/reset/{token}', [ForgotPasswordController::class,'showLinkRequestForm']);


Route::get('/model/register', function () {
    return view('index');
});
Route::get('/model/login', function () {
    return view('index');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/employer', function () {
    return view('index');
});

Route::get('/employer/home/applicants', function () {
    return view('index');
});

Route::get('/employer/home/model', function () {
    return view('index');
});
Route::get('/employer/register', function () {
    return view('index');
});

Route::get('/joblists', function () {
    return view('index');
});

Route::get('/job/{id}', function () {
  
    return view('index');
});

Route::get('/pricing' , function(){
    return view('index');
});
Route::get('/aboutus' , function(){
    return view('index');  
});

Route::get('/contactus' , function(){
    return view('index');  
});

Route::get('/modelfaq' , function(){
    return view('index');  
});

Route::get('/employerfaq' , function(){
    return view('index');  
});

#TESTING ROUTES
Route::middleware('auth:sanctum')->get('removetoken', function () {
    return  auth()->user()->tokens()->delete();
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// # AUTHENTICATED LINKS
Route::group(['middleware'=>['auth:sanctum']] , function(){

    Route::get('/model/notification/{id}', function () {
        return view('index');
    });

    Route::get('/{any}', function () {
        return view('index');
    });
    Route::get('/{any}', function () {
        return view('index');
    });
    Route::get('/model/{any}', function () {
        return view('index');
    });
    Route::get('/employer/{any}', function () {
        return view('index');
    });
    
});



//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


