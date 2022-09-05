<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthCheckerController;

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
    
    Route::get("/cUL" , [AuthCheckerController::class, 'index'] ); # check user logged
    Route::post("/updateinfo" , [AuthCheckerController::class, 'updateinfo'] );
    Route::post("/updateinfosocial" , [AuthCheckerController::class, 'updateinfosocial'] );
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
   
// });
