<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CitiesController extends Controller
{


    //Get All Cities
    public function GetCities(){

        $cities=City::with(['country'])->get();

        return view('Admin.Cities.index',compact('cities'));

    }


    //Get Add City View

    public function AddCity(){

        $countries=Country::get();

        return view('Admin.Cities.create',compact('countries'));

    }


    //Add City To Database Code


    public function CreateCity(CityRequest $req){

            $city=City::create([
                'country_id'    =>$req->country_id
            ]);

            $city->name=$req->name;

            $city->save();

    return redirect()->back()->with(['success'=>'New city added']);

        if(!$city){
            return redirect()->back()->with(['error'=>'Error while adding new city']);

        }

    }



    // Get Edit City view

    public function EditCity($id){
        $data=[];
        $data['city']=City::find($id);
    if(!$data['city']){
    return redirect()->back()->with(['error'=>'This id does not exist any more']);
    }else{
        $data['countries']=Country::get();


        return view('Admin.Cities.edit',$data);
        }
    }

    // Update City Code

    public function UpdateCity(CityRequest $req){

        $city=City::find($req->id);

        if($city){
            $city->update([
                'country_id'    => $req->country_id,
            ]);


            $city->name=$req->name;

            $city->save();


        return redirect()->back()->with(['success'=>'City info updated']);

        }else{
            return redirect()->back()->with(['error'=>'Error while updaitng city with id'.$req->id]);

        }
    }

    // Delete City Code

    public function DeleteCity($id){

        $city=City::find($id);
        if(!$city){
            return redirect()->back()->with(['error'=>'This id does not exist any more']);
            }else{
        $city->delete();

        return redirect()->back();
            }
    }




}