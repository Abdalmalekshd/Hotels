<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Rating;
use App\Models\Reservation;
use Axiom\Rules\Uppercase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;

class HomeController extends ResponseController
{
    public function home(){
        $data=[];

        $data['Hotels']=Hotel::Active()
        ->with('ratingrelation')
        ->withCountRooms(today(),today()->addDay())->with('translations',function($q){
            $q->where('locale',config('app.locale'));
        })->
        inRandomOrder()->
        simplePaginate(5);



         return     $data['Hotels'] ?  $this->sendResponse($data,'User Home:'):  $this->sendError("404 Closed temporarily For maintenance");




    }


    public function usersearch(Request $req)
    {

         $country=ucfirst($req->country);

         $checkoutDate = Carbon::parse($req->checkout);
         $checkinDate = Carbon::parse($req->checkin);


        $data['search'] = Hotel::Active()
       ->withCountRooms($checkinDate, $checkoutDate)->
       WhereHasContryInThisName($country)->with('translations',function($q){
        $q->where('locale',config('app.locale'));
    })
       ->get();


        return $this->sendResponse($data['search'],'Search Result:');
}
}