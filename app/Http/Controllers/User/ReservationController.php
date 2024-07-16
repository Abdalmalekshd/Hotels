<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{



    public function UserReservations(){
        $data['reservations']=Reservation::where(function($qu){
            $qu->where('status',1)->where('user_id',Auth()->user()->id);
        })->get();
        return view('User.Reservations.index',$data);
    }

    public function resrivation(ReservationRequest $request){
        try{

            //Check if this user already booked this room
            DB::beginTransaction();
                $previusreserve=Reservation::where('hotel_id',$request->hotel_id)->
            where('room_id',$request->room_id)->where('user_id',Auth::user()->id)->
            where('reservations_start_date',$request->start_date)->
            where('reservations_end_date' ,$request->end_date)->first();

            //Check if this room already reserved in that date
              $alreadyreserved=Reservation::where('hotel_id',$request->hotel_id)->
            where('room_id',$request->room_id)->where('reservations_start_date',$request->start_date)
            ->first();


            if(!$alreadyreserved && !$previusreserve && Carbon::now()->format('Y-m-d') < $request->start_date ){

            Reservation::create([
                'hotel_id'              =>$request->hotel_id,
                'room_id'               =>$request->room_id,
                'user_id'               =>Auth::user()->id,
                'reservations_start_date' =>$request->start_date,
                'reservations_end_date' =>$request->end_date,
            ]);
            DB::commit();

            return redirect()->back()->with(['success'=>__('user.resersuccess')]);
        }else{
            return redirect()->back()->with(['error'=>__('user.resererror')]);
        }

        }
        catch(\Exception $ex){

            DB::rollBack();
            return redirect()->back()->with(['error'=>__('user.resererror')]);

        }
    }


    public function CompleteReservations($id){
        $data['room']=Room::find($id);
        return view('User.reserform',$data);
    }


    public function cancelresrivation($id){
        $delreser=Reservation::find($id);

        if($delreser){
            $delreser->delete();
            return redirect()->back(); //Ajax
        }else{
            return redirect()->back()->with(['error'=>'This reservation does not exist']);
        }
    }
}