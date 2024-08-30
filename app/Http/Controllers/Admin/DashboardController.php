<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardController extends Controller
{
    public function Dashboard(){
        $data[]='';
        //Count Query
         $data['countrynumber']= Country::count();
         $data['citynumber']= City::count();
         $data['hotelnumber']= Hotel::count();
        $data['attachnumber']=Attachment::count();
        $data['usersnumber']=User::count();

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



        return view("Admin.Dashboard", $data);

    }



    public function DeleteUser($id){
    $user=User::find($id);
        if($user){
            $user->delete();
            return redirect()->back();
        }else{
            return redirect()->back()->with(['error'=> 'This user does not exist any more']);

        }
    }
}
