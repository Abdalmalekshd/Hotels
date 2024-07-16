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


Route::group(['namespace'=>'App\Http\Controllers\API\User','middleware'=>'guest:api'],function(){

    //Start Login Route



    Route::post('user_signup','LoginController@usersignup')->name('user.createacc');


    Route::post('user_Login','LoginController@userlogin')->name('user.signin');


    Route::post('user_forgetpassword','LoginController@forgetpassword')->name('User.forgetpassword');

    //End Login Route


});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localization'],
        'namespace'=>'App\Http\Controllers\API\User'
    ], function(){
        Route::get('Home','HomeController@home')->name('home');

        Route::group(['prefix'=>'user/hotels','middleware' => ['auth:api']],function(){

    //Start Home Routes
        Route::get('home','HomeController@home')->name('home');

        Route::get('User_Search','HomeController@usersearch')->name('user.search');

    //End Home Routes


//Start Favorites Routes
Route::get('fav/addtofav/{id}','FavoritesController@addtofav')->name('addtofav');
Route::get('fav/showfav','FavoritesController@showfav')->name('showfav');

Route::get('fav/remove_from_fav/{id}','FavoritesController@removefromfav')->name('removefromfav');


Route::get('fav/search_in_fav','FavoritesController@searchinfav')->name('searchinfav');
//End Favorites Routes



//Start Hotel Routes

Route::get('PreviewHotel/{id}','User_Hotel_Controller@previewhotel')->name('prehotel');

Route::get('PreviewRoom/{id}','User_Hotel_Controller@previewRoom')->name('room.showinfo');


Route::post('/save-rating', 'User_Hotel_Controller@UserRating')->name('rate.hotel');

//End Hotel Routes

//Start Reservation Routes

Route::get('My_Reservations','ReservationController@UserReservations')->name('user.reservation');

Route::get('reser','ReservationController@reservation')->name('resrive.room');

Route::get('cancelreser/{id}','ReservationController@cancelresrivation')->name('del.resrivation');



// Route::get('CompleteReser/{id}','ReservationController@CompleteReservations')->name('complete.reser');




Route::get('My_Cart','CartController@Cart')->name('My_Cart');

Route::get('payment','PaymentController@checkout')->name('payment');





//End Reservation Routes




});


});