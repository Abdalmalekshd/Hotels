<?php

namespace App\Http\Controllers\API\Hotel;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends ResponseController
{
    public function GetReservations(){
       $data=[];
        $data['reservations'] = Reservation::orderBy("created_at","desc")->paginate(10);

         return $this->sendResponse($data,'Reservations:');
    }



}