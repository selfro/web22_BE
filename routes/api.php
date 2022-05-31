<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('offers',[OfferController::class, 'index']);
Route::get('offers/{id}',[OfferController::class, 'findById']);
Route::get('offers/checkid/{id}',[OfferController::class, 'checkID']);
Route::get('offers/findtutor/{id}',[OfferController::class, 'findTutor']);

Route::group(['middleware' => ['api', 'auth.jwt']], function() {
    Route::post('offers',[OfferController::class,'save']);
    Route::get('offers/user/{id}',[OfferController::class, 'getOwnCoachings']);
    Route::put('offers/{id}',[OfferController::class,'update']);
    Route::delete('offers/{id}',[OfferController::class,'delete']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::put('offers/savecomment/{id}',[OfferController::class,'saveComment']);
    Route::put('offers/bookoffer/{id}',[OfferController::class,'bookOffer']);
});

Route::post('auth/login',[AuthController::class,'login']);



