<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Hotel;
use App\Models\Rating;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User_Hotel_Controller extends Controller
{
    public function previewhotel($id){
        $data=[];

        $data['hotel']=Hotel::Active()->find($id);

        if($data['hotel']){

         $data['rating']=Rating::where('hotel_id',$id)->sum('rating')/5;



        $data['rooms']=Room::where('hotel_id',$id)->get();

        return view('User.Hotel',$data);
    }else{
        return redirect()->back()->with(["error"=>"Sorry This Hotel Does'nt Not Exist"]);
    }
    }


    public function previewRoom($id){

        $data['room']=Room::with('hotel')->find($id);

        return view('User.Room.index',$data);
    }


    public function UserRating(Request $request)
    {
        $rate=Rating::create([
            'user_id' =>$request->user_id,
            'hotel_id'=>$request->hotel_id,
            'rating' =>$request->rating,

        ]);


        if ($rate) {

            return response()->json(['status' =>true,
        'Msg'=>'Rating Added successfully']);



        } else {
            return 'error';
        }
    }




}