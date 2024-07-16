<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardController extends ResponseController
{
    public function Dashboard(){
        $data[]='';
        //Count Query
         $data['countrynumber']= Country::get()->count();
         $data['citynumber']= City::get()->count();
         $data['hotelnumber']= Hotel::get()->count();
        $data['attachnumber']=Attachment::get()->count();
        $data['usersnumber']=User::get()->count();

         //Data Query
        $data['Countries']=Country::limit(5)->OrderByDesc('id')->withcount('cities')->get();

        $data['Cities']=City::limit(5)->OrderByDesc('id')->withcount('Hotels')->get();

        $data['Hotels']=Hotel::limit(5)->OrderByDesc('id')->withcount('rooms')->get();


        $data['Attach']=Attachment::select([
            'id',
            'name_'. LaravelLocalization::getCurrentLocale()      . ' as name',
            'slug'
        ])->limit(5)->OrderByDesc('id')->get();

        $data['Users']=User::limit(5)->OrderByDesc('id')->get();



        return $this->sendResponse($data,'Dashboard');

    }



    public function DeleteUser($id){
    $user=User::find($id);
        if($user){
            $user->delete();
            return $this->sendResponse($user,$user.'User deleted successfully');
            ;
        }else{
            return $this->sendError('This user does not exist any more');

        }
    }
}