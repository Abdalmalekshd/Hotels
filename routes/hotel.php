<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Login  routes
Route::group(
    [
        'prefix'=>'Hotels',
        'namespace'=>'App\Http\Controllers\Hotel','middleware'=>'guest:hotel'], function(){
Route::get('login','LoginController@login')->name('login');

Route::post('signin','LoginController@signin')->name('signin');


});


//Hotel routes

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace'=>'App\Http\Controllers\Hotel'
    ], function(){


Route::group(['prefix'=>'Hotels','middleware'=> ['auth:hotel']], function(){


        //Start Hotel Routes

        Route::get('Hotel_Profile','HotelController@HotelProfile')->name('hotel.profile');


        Route::get('Edit_Hotel','HotelController@EditHotel')->name('edit.hotel');

        Route::post('update_hotel','HotelController@UpdateHotel')->name('update.hotel');


        Route::get('edit_hotel_password','HotelController@EditHotelPass')->name('edit.hotel.pass');

        Route::post('update_hotel_password','HotelController@UpdateHotelPass')->name('update.hotel.pass');

        Route::get('requestactivate','HotelController@requestactivation')->name('req.hotel.active');



        //End Hotel Routes

        //Start Room Routes


    Route::get('/','RoomsController@GetRooms')->name('get.rooms');


    Route::get('Add_Room','RoomsController@AddRooms')->name('add.room');

    Route::post('create_room','RoomsController@CreateRooms')->name('create.new.room');

    Route::get('edit_room/{id}','RoomsController@EditRoom')->name('edit.room');

    Route::post('update_room','RoomsController@UpdateRoom')->name('update.room');


    Route::get('delete_room/{id}','RoomsController@DeleteRooms')->name('delete.room');

    //End Room Routes

    //Start Reservation Routes
    Route::get('Reservations','ReservationController@GetReservations')->name('get.reservation');

    //بقيان حذف وتعديل

    //End Reservation Routes


    });


    Route::get('forgetpass','LoginController@forgetpass')->name('Hotel.forgetpass');

    Route::post('forgetpassword','LoginController@forgetpassword')->name('Hotel.forgetpassword');

    Route::get('Resetpassword/{email}','LoginController@Resetpassword')->name('Hotel.Resetpassword');

    Route::post('Resetpass','LoginController@Resetpass')->name('Hotel.Resetpass');



    Route::get('logout','LoginController@logout')->name('logout');


});
