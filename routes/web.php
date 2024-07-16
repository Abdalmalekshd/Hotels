<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\FavoritesController;

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


Route::group(['namespace'=>'App\Http\Controllers\User','middleware'=>'guest:web'],function(){

    //Start Login Route

    Route::get('signup','LoginController@signup')->name('user.signup');

    Route::post('user_signup','LoginController@usersignup')->name('user.createacc');


    Route::get('userLogin','LoginController@login')->name('user.login');

    Route::post('user_Login','LoginController@userlogin')->name('user.signin');


    Route::get('user_forgetpass','LoginController@forgetpass')->name('User.forgetpass');

    Route::post('user_forgetpassword','LoginController@forgetpassword')->name('User.forgetpassword');

    Route::get('user_Resetpassword/{email}','LoginController@Resetpassword')->name('User.Resetpassword');


    Route::post('user_Resetpass','LoginController@Resetpass')->name('User.Resetpass');


    //End Login Route


});


Route::group(['namespace'=>'App\Http\Controllers\User','middleware'=>'guest:web'],function(){

    //Start Login Route

    Route::get('signup','LoginController@signup')->name('user.signup');

    Route::post('user_signup','LoginController@usersignup')->name('user.createacc');


    Route::get('userLogin','LoginController@login')->name('user.login');

    Route::post('user_Login','LoginController@userlogin')->name('user.signin');


    Route::get('user_forgetpass','LoginController@forgetpass')->name('User.forgetpass');

    Route::post('user_forgetpassword','LoginController@forgetpassword')->name('User.forgetpassword');

    Route::get('user_Resetpassword/{email}','LoginController@Resetpassword')->name('User.Resetpassword');


    Route::post('user_Resetpass','LoginController@Resetpass')->name('User.Resetpass');


    //End Login Route


});

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace'=>'App\Http\Controllers\User'
    ], function(){

    Route::get('home','HomeController@home')->name('home');

    Route::group(['prefix'=>'user/hotels','middleware' => ['auth']],function(){

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


    Route::get('CompleteReser/{id}','ReservationController@CompleteReservations')->name('complete.reser');

    Route::get('cancelreser/{id}','ReservationController@cancelresrivation')->name('del.resrivation');



    Route::get('My_Cart','CartController@Cart')->name('My_Cart');

    Route::get('payment','PaymentController@checkout')->name('payment');

    Route::post('/checkout', 'PaymentController@checkout')->name('process.payment');

    Route::get('/success/{id}', 'PaymentController@success')->name('success');
    //End Reservation Routes


    // Route::get('withsamerating/{id}','HotelController@withsamerating')->name('WithSameRating');


    Route::get('user_logout','LoginController@userlogout')->name('User.logout');


});


});
