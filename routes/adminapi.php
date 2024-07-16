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



/*
Personal access client created successfully.
Client ID: 1
Client secret: 9xzbp9q3ZHawLRGv364vTLZkVZH95kYHtJsuI417
Password grant client created successfully.
Client ID: 2
Client secret: KJRUBBEks9eaEKzCb2M7hj38dYUz8FgsliOoP9eV
*/


Route::post('admin_login','App\Http\Controllers\API\Admin\LoginController@adminsignin')->name('admin.login');



    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localization','auth:adminapi'],
            'namespace'=>'App\Http\Controllers\API\Admin'
        ], function(){

//Start Dashboard Route
Route::get('/','DashboardController@Dashboard')->name('dashboard');

//End Dashboard Route

    //Start Countries Routes


    Route::get('countries','CountriesController@GetCountries')->name('get.countries');



    Route::post('create_Country','CountriesController@CreateCountry')->name('create.new.country');


    Route::post('update_Country/{id}','CountriesController@UpdateCountry')->name('update.country');

    Route::get('delete_country/{id}','CountriesController@DeleteCountry')->name('delete.country');


    //End Countries Routes



    //Start Cities Routes


    Route::get('cities','CitiesController@GetCities')->name('get.cities');



    Route::post('create_City','CitiesController@CreateCity')->name('create.new.city');



    Route::post('update_City/{id}','CitiesController@UpdateCity')->name('update.city');

    Route::get('delete_city/{id}','CitiesController@DeleteCity')->name('delete.city');


    //End Cities Routes


    //Start Hotel Routes
    Route::get('/hotels','HotelsController@GetHotels');

    Route::post('Create_Hotel','HotelsController@CreateHotels');

    Route::post('Edit_Hotel/{id}','HotelsController@UpdateHotels');



    Route::get('Delete_Hotel/{id}','HotelsController@DeleteHotels')->name('delete.hotel');

    // Route::get('/hotel/{id}','HotelsController@GetHotelById')->name('get.single.hotel');

    Route::get('activate/{id}','HotelsController@ActivateHotel')->name('activate.hotel');

    Route::get('search','HotelsController@SearchHotel')->name('search.hotel');
    //End Hotel Routes



    //Start Attachment Routes

    Route::get('Attachment','AttachmentsController@GetAttachments')->name('get.attachments');

    Route::post('Create_Attachment','AttachmentsController@CreateAttachments')->name('create.attachments');

    Route::post('update_Attachment/{id}','AttachmentsController@UpdateAttachments')->name('update.attachment');

    Route::get('Delete_Attachment/{id}','AttachmentsController@DeleteAttachments')->name('delete.attachment');

    //End Attachment Routes


    Route::get('Delete_User/{id}','DashboardController@DeleteUser')->name('delete.user');



    Route::get('logout','LoginController@adminlogout')->name('admin.logout');


});