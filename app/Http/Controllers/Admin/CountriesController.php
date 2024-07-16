<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Mockery\Expectation;

class CountriesController extends Controller
{

    //Get All Countries
    public function GetCountries(){

        $countries=Country::get();

        return view('Admin.Countries.index',compact('countries'));

    }


    //Get Add Country View

    public function AddCountry(){
        return view('Admin.Countries.create');

    }


    //Add Country To Database Code


    public function CreateCountry(CountryRequest $req){

            $country=Country::create([]);

            $country->name=$req->name;

            $country->save();

    return redirect()->back()->with(['success'=>'New Country Added']);

        if(!$country){
            return redirect()->back()->with(['error'=>'Error while adding new country']);

        }

    }



    // Get Edit Country view

    public function EditCountry($id){
        $data=[];
        $data['country']=Country::find($id);

        if(!$data['country']){
            return redirect()->back()->with(['error'=>'This id does not exist any more']);
            }else{

        return view('Admin.Countries.edit',$data);
            }
    }

    // Update Country Code

    public function UpdateCountry(CountryRequest $req){

        $country=Country::find($req->id);

        if($country){
            $country->update([]);

            $country->name=$req->name;

            $country->save();

        return redirect()->back()->with(['success'=>'Country info updated']);

        }else{
            return redirect()->back()->with(['error'=>'Error while updaitng country with id'.$req->id]);

        }
    }

    // Delete Country Code

    public function DeleteCountry($id){

        $country=Country::find($id);

        if(!$country){
            return redirect()->back()->with(['error'=>'This id does not exist any more']);
            }else{


        $country->delete();

        return redirect()->back();
            }
    }


}
