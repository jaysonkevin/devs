<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CountryCode;;
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

Route::post('/register', [RegisterController::class, 'create']);


# PUBLIC ROUTES 
Route::get("/country_code" , [CountryCode::class, 'index'] );



# PROTECTED ROUTES VIA SANCTUM
Route::group(['middleware'=>['auth:sanctum']] , function(){
    Route::get("/user" , function(){
        return auth()->user();
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
   
// });
