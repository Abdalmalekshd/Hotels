<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(
    [
        'prefix'=>'Hotels',
        'namespace'=>'App\Http\Controllers\API\Hotel','middleware'=>'guest:hotelapi'], function(){


Route::post('signin','LoginController@signin')->name('signin');


});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localization','auth:hotelapi'],
        'namespace'=>'App\Http\Controllers\API\Hotel'
    ], function(){

        Route::get('Hotel_Profile','HotelController@HotelProfile')->name('hotel.profile');

        // Route::post('update_hotel','HotelController@UpdateHotel')->name('update.hotel');


    });