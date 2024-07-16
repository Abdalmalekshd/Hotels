<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Hotel;
use App\Models\Rating;
use App\Models\Room;
use App\Traits\FunctionsFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User_Hotel_Controller extends ResponseController
{
    use FunctionsFolder;
    public function previewhotel($id){
        $data=[];

        $data['hotel']=Hotel::Active()->with('translations',function($q){
            $q->where('locale',config('app.locale'));
        })->find($id);

        if($data['hotel']){

         $data['rating']=Rating::where('hotel_id',$id)->sum('rating')/5;



        $data['rooms']=Room::where('hotel_id',$id)->get();

        return $this->sendResponse($data,"Preview Hotel".' '.$data['hotel']->name.' '.':');
    }else{
        return $this->sendError("Sorry This Hotel Does'nt Exist");
    }
    }


    public function previewRoom($id){

        $data['room']=Room::with(['hotel'=>function($q){
            $this->WhereTranslationIsLocale($q);
        }])->find($id);

        if($data['room']){
        return $this->sendResponse($data,'Preview Room With ID '. $id .' From Hotel '.$data['room']->hotel->name);
    }else
    {
        return $this->sendError("This Room Does'nt Exist");
    }
}


    public function UserRating(Request $request)
    {


        if(! Hotel::find($request->hotel_id)) {

            return $this->sendError("This Hotel Does'nt Exist");

        }else{
            $rate=Rating::create([
                'user_id' =>Auth::user()->id,
                'hotel_id'=>$request->hotel_id,
                'rating' =>$request->rating,

            ]);
                return$this->sendResponse($rate,'Rating Added successfully');
        }



    }




}