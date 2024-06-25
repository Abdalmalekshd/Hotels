<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function GetReservations(){
       $data=[];
        $data['reservations'] = Reservation::orderBy("created_at","desc")->paginate(10);

         return view('Hotel.Reservastions.index', $data);
    }



}
