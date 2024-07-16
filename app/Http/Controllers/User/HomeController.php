<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Rating;
use App\Models\Reservation;
use Axiom\Rules\Uppercase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;

class HomeController extends Controller
{
    public function home(){
        $data=[];

        $data['Hotels']=Hotel::Active()
        ->with('ratingrelation')
        ->withCountRooms(today(),today()->addDay())->
        inRandomOrder()->
        simplePaginate(5);


         $data['search']='';

        if($data['Hotels']){
            return view('user.home',$data);

        }else{
        return redirect()->back()->with(["error"=>"404 Closed temporarily For maintenance"]);
        // return abort('404');

        }

    }


    public function usersearch(Request $req)
    {

         $country=ucfirst($req->country);

         $checkoutDate = Carbon::parse($req->checkout);
         $checkinDate = Carbon::parse($req->checkin);


        $data['search'] = Hotel::Active()
       ->withCountRooms($checkinDate, $checkoutDate)->
       WhereHasContryInThisName($country)
       ->get();



        $data['Hotels']='';

        return view('user.home',$data);

    }



}
