<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\FunctionsFolder;

class CitiesController extends ResponseController
{
    use FunctionsFolder;


    //Get All Cities
    public function GetCities(){

        $cities=City::with(['country'=>function($q){
            $this->WhereTranslationIsLocale($q);
        }])->with('translations',function($q){
            $q->where('locale',config('app.locale'));
        })->get();

        return $this->sendResponse($cities,'Cities');


    }




    //Add City To Database Code


    public function CreateCity(CityRequest $req){

            $city=City::create([
                'country_id'    =>$req->country_id
            ]);

            $city->name=$req->name;

            $city->save();

            return $this->sendResponse($city,'New city added');

        if(!$city){
            return $this->sendError('Error while adding new city');

        }

    }




    // Update City Code

    public function UpdateCity(UpdateCityRequest $req,$id){

        $city=City::find($id);

        if($city){
            $city->update([
                'country_id'    => $req->country_id,
            ]);


            $city->name=$req->name?:$city->name;

            $city->save();


            return $this->sendResponse($city,'City info updated');

        }else{
            return $this->sendError('Error while updaitng city Where id is :' . $id);

        }
    }

    // Delete City Code

    public function DeleteCity($id){

        $city=City::find($id);
        if(!$city){
            return $this->sendError('This id does not exist any more');
            }else{
        $city->delete();

        return $this->sendResponse($city,$city->name.' Deleted Successffully');
            }
    }




}