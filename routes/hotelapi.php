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

        //Start Hotel Routes

        Route::get('Hotel_Profile','HotelController@HotelProfile')->name('hotel.profile');

        Route::post('update_hotel','HotelController@UpdateHotel')->name('update.hotel');


        Route::post('update_hotel_password','HotelController@UpdateHotelPass')->name('update.hotel.pass');

        Route::get('requestactivate','HotelController@requestactivation')->name('req.hotel.active');

        //End Hotel Routes




    //Start Room Routes


    Route::get('/','RoomsController@GetRooms')->name('get.rooms');

    Route::post('create_room','RoomsController@CreateRooms')->name('create.new.room');

    Route::post('update_room/{id}','RoomsController@UpdateRoom')->name('update.room');

    Route::get('delete_room/{id}','RoomsController@DeleteRooms')->name('delete.room');

     //End Room Routes


      //Start Reservation Routes
      Route::get('Reservations','ReservationController@GetReservations')->name('get.reservation');

      //بقيان حذف وتعديل

      //End Reservation Routes



      Route::post('forgetpassword','LoginController@forgetpassword')->name('Hotel.forgetpassword');


    Route::get('hotel_logout','LoginController@logout')->name('logout');

    });