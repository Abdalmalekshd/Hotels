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

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'guest:admin'],function(){

//Start Login Route
Route::get('adminLogin','LoginController@adminlogin')->name('admin.login');

Route::post('admin_Login','LoginController@adminsignin')->name('admin.signin');

//End Login Route
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:admin'],
        'namespace'=>'App\Http\Controllers\Admin',

    ], function(){


Route::group(['prefix'=>'Hotels/admin'],function(){



        //Start Dashboard Route
        Route::get('/','DashboardController@Dashboard')->name('dashboard');

        //End Dashboard Route

    //Start Countries Routes


    Route::get('countries','CountriesController@GetCountries')->name('get.countries');

    Route::get('Add_Country','CountriesController@AddCountry')->name('add.country');

    Route::post('create_Country','CountriesController@CreateCountry')->name('create.new.country');


    Route::get('Edit_Country/{id}','CountriesController@EditCountry')->name('edit.country');

    Route::post('update_Country','CountriesController@UpdateCountry')->name('update.country');

    Route::get('delete_country/{id}','CountriesController@DeleteCountry')->name('delete.country');


    //End Countries Routes



    //Start Cities Routes


    Route::get('cities','CitiesController@GetCities')->name('get.cities');

    Route::get('Add_City','CitiesController@AddCity')->name('add.city');

    Route::post('create_City','CitiesController@CreateCity')->name('create.new.city');


    Route::get('Edit_City/{id}','CitiesController@EditCity')->name('edit.city');

    Route::post('update_City','CitiesController@UpdateCity')->name('update.city');

    Route::get('delete_city/{id}','CitiesController@DeleteCity')->name('delete.city');


    //End Cities Routes





    //Start Hotel Routes

        Route::get('/hotels','HotelsController@GetHotels')->name('get.hotels');

        Route::get('Add_Hotel','HotelsController@AddHotels')->name('add.hotel');

        Route::post('create_hotel','HotelsController@CreateHotels')->name('create.new.hotel');

        Route::get('Edit_Hotel/{id}','HotelsController@EditHotels')->name('admin.edit.hotel');

        Route::post('update-hotel','HotelsController@UpdateHotels')->name('admin.update.hotel');

        Route::get('delete_hotel/{id}','HotelsController@DeleteHotels')->name('delete.hotel');

        // Route::get('/hotel/{id}','HotelsController@GetHotelById')->name('get.single.hotel');

        Route::get('activate/{id}','HotelsController@ActivateHotel')->name('activate.hotel');

        Route::get('search','HotelsController@SearchHotel')->name('search.hotel');


    //End Hotel Routes


    //Start Attachment Routes

    Route::get('Attachment','AttachmentsController@GetAttachments')->name('get.attachments');

    Route::get('Add_Attachment','AttachmentsController@AddAttachments')->name('add.attachments');

    Route::post('Create_Attachment','AttachmentsController@CreateAttachments')->name('create.attachments');

    Route::get('Edit_Attachment/{id}','AttachmentsController@EditAttachments')->name('edit.attachment');

    Route::post('update_Attachment/{id}','AttachmentsController@UpdateAttachments')->name('update.attachment');


    Route::get('Delete_Attachment/{id}','AttachmentsController@DeleteAttachments')->name('delete.attachment');



    //End Attachment Routes


    Route::get('Delete_User/{id}','DashboardController@DeleteUser')->name('delete.user');




    Route::get('logout','LoginController@adminlogout')->name('admin.logout');

    });





});