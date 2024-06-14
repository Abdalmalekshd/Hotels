<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function Cart(){

        $data['reserve']=Reservation::with('hotel','room')->where(
            ['user_id'=>Auth::user()->id
            ,
            'status'=>0
            ])->get();

        $data['totalcost']= Room::whereHas('rerservation',function($q){
          $q->where(
            ['user_id'=>Auth::user()->id
            ,
            'status'=>0
            ]);
         })->get()->sum('cost');


         $data['totalcostwithtax']=$data['totalcost'] * 0.1;

         $data['overalltotal']=$data['totalcostwithtax'] + $data['totalcost'];

        return view('User.PaymentWays',$data);

    }
}
