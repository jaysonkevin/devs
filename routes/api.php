<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthCheckerController;
use App\Http\Controllers\UserImageController;

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

Route::post('/register', [RegisterController::class, 'create']);
Route::get("/country" , [CountryController::class, 'index'] );
Route::get("/ip" , [CountryController::class, 'getIp'] );




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
    #END MODEL
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
   
// });
