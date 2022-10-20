<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthCheckerController;
use App\Http\Controllers\UserImageController;
use App\Http\Controllers\EmployerCompanyController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ModelNotificationController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\SubscriptionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# PUBLIC ROUTES 
Route::post('/resetpassword' , [ForgotPasswordController::class,'sendResetLinkEmail']);
Route::post('/reset-password'  , [ResetPasswordController::class,'reset']);
Route::post("contactus" ,[ContactUsController::class,'contact_us']);
# CHECK IF TOKEN IS EXPIRED OR NOT
Route::post("checkResetToken" , [ResetPasswordController::class,'checkResetToken']);

Route::post('/register', [RegisterController::class, 'create']);
Route::post('/resendEmailRegistration', [RegisterController::class, 'resendEmailRegistration']);
Route::get("/country" , [CountryController::class, 'index'] );

Route::get("/location" , [AuthCheckerController::class, 'location'] );

//Route::get("/ip" , [CountryController::class, 'getIp'] );


Route::post('activejobs', [ JobController::class, 'activejobs' ]);
Route::get('job/{id}', [ JobController::class, 'job' ]);
Route::get('jobType', [ JobTypeController::class, 'index' ]);
Route::get("session_bearer" , [AuthCheckerController::class , 'session_bearer']);

# PROTECTED ROUTES VIA SANCTUM
Route::group(['middleware'=>['auth:sanctum']] , function(){

    # CHECK IF USER HAS LOGGED IN
    Route::get("/_c_" , [AuthCheckerController::class, 'checker'] ); # check user logged
    
    Route::get("/cUL" , [AuthCheckerController::class, 'index'] ); # check user logged
    # MODEL
    Route::post("/updateinfo" , [AuthCheckerController::class, 'updateinfo'] );
    Route::post("/updateinfosocial" , [AuthCheckerController::class, 'updateinfosocial'] );
    Route::get("/getImage" , [UserImageController::class, 'index'] );
    Route::post('imageUpload', [ UserImageController::class, 'imageUpload' ]);
    Route::post('logout', [ AuthCheckerController::class, 'logout' ]);  
    Route::get('mNotification', [ ModelNotificationController::class, 'index' ]);  
    Route::get('getNotifListM', [ ModelNotificationController::class, 'getNotifListM' ]);  
    Route::post('getRatingsData', [ ModelNotificationController::class, 'getRatingsData' ]);  
    Route::post('removeImg', [ UserImageController::class, 'removeImg' ]); 
    #END MODEL


    # EMPLOYER
    Route::post('updateCompany', [ EmployerCompanyController::class, 'updateCompany' ]);
    Route::post('jobs', [ JobController::class, 'index' ]);
    Route::post('addjob', [ JobController::class, 'addjob' ]);
    Route::post('editjob', [ JobController::class, 'editjob' ]);
    Route::post('removejob', [ JobController::class, 'removejob' ]);
    Route::post('apply', [ JobController::class, 'apply' ]);
    Route::post('myapplication', [ JobApplicationController::class, 'index' ]);
    Route::get('newapplicants', [ JobApplicationController::class, 'newapplicants' ]);
    Route::get('newapplicantsList', [ JobApplicationController::class, 'newapplicantsList' ]);
    Route::post('applicants', [ JobApplicationController::class, 'applicants' ]);
    Route::post('applicant', [ JobApplicationController::class, 'applicant' ]);
    Route::post('hire', [ JobApplicationController::class, 'hire' ]); 
    Route::post('rateApplicant', [ JobApplicationController::class, 'rateApplicant' ]);   
    Route::post('rate_description', [ JobApplicationController::class, 'rate_description' ]); 
    Route::post('subscriptions', [ SubscriptionController::class, 'index' ]);
    #END EMPLOYER


    #CHECKOUT
    Route::post("checkout" ,[PaymentsController::class ,'checkout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
   
// });
