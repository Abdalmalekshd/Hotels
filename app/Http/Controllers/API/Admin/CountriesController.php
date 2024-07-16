<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Mockery\Expectation;

class CountriesController extends ResponseController
{

    //Get All Countries
    public function GetCountries(){

        $countries=Country::with('translations',function($q){
            $q->where('locale',config('app.locale'));
        })->get();

        return $this->sendResponse($countries,'Countries :');


    }





    //Add Country To Database Code


    public function CreateCountry(CountryRequest $req){

            $country=Country::create([]);

            $country->name=$req->name;

            $country->save();

            return $this->sendResponse($country,'New Country Added');
        if(!$country){
            return $this->sendError('Error while adding new country');

        }

    }





    // Update Country Code

    public function UpdateCountry(UpdateCountryRequest $req,$id){

        $country=Country::find($id);

        if($country){
            $country->update([]);

            $country->name=$req->name?:$country->name;

            $country->save();


        return $this->sendResponse($country,'Country info updated');


        }else{
            return $this->sendError('Error while updating country');


        }
    }

    // Delete Country Code

    public function DeleteCountry($id){

        $country=Country::find($id);

        if(!$country){
            return $this->sendError('Error while deleteing this id');

            }else{


        $country->delete();

        return $this->sendResponse($country,'Country deleted successfully');

            }
    }


}