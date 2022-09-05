<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['signed'])->name('verification.verify');
Route::get('/model/register', function () {
    return view('index');
});
Route::get('/model/login', function () {
    return view('index');
});
Route::get('/', function () {
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


