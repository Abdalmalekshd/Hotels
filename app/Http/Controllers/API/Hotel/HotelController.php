<?php

namespace App\Http\Controllers\API\Hotel;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\Hotels\HotelProfile;
use App\Http\Requests\Hotels\HotelProfileApi;
use App\Mail\RequestActivationMail;
use App\Models\Admin;
use App\Models\Attachment;
use App\Traits\UplaodImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\HotelAttachment;
use App\Models\Room;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HotelController extends ResponseController
{

    use UplaodImageTraits;
    public function HotelProfile(){
        $data=[];
         $data['hotel']=Hotel::with(['translations'=>function($q){
            $q->where('locale',config('app.locale'));
        }])->find(Auth::user()->id);

         $data['rooms']=Room::where('hotel_id',Auth::user()->id)->get();

        return $this->sendResponse($data,'Hotel Profile:');

    }



    public function UpdateHotel(HotelProfileApi $request){

        $hotel=Hotel::find(Auth::user()->id);
        $hotel->update([
        'name'      =>$request->name?:$hotel->name,
        'email'     =>$request->email?:$hotel->email,
        'phone'     =>$request->phone?:$hotel->phone,

    ]);

        if($request->input('photo')){

            $des ='storage/hotels/' . $hotel->photo;

           if (File::exists($des)) {
                File::delete($des);

       }
            $img=$this->UploadImage('hotels',$request->photo);
       $hotel->photo= $img;

        }

     $hotel->latitude=$request->latitude?:$hotel->latitude;
     $hotel->longitude=$request->longitude?:$hotel->longitude;



        $hotel->save();

        $hotelAttach=HotelAttachment::where('hotel_id',$hotel->id)->first();
            if($hotelAttach && $request->has('attach')){

                $hotelAttach->update([
                    'attachemnts'=>json_encode($request->attach)?:$hotelAttach->attachemnts
                ]);

            }elseif($request->has('attach') && !$hotelAttach ){
            $hotelAttach=new HotelAttachment();
            $hotelAttach->hotel_id = $hotel->id;
            $hotelAttach->attachemnts=json_encode($request->attach)?:$hotelAttach->attachemnts;
            $hotelAttach->save();
         }

        return $this->sendResponse($hotel,'Profile Updated');


    }



    public function UpdateHotelPass(EditPasswordRequest $req){
        $hotel=Hotel::find(Auth::user()->id);

        if(Hash::check($req->old_pass,$hotel->password))
    {

        $hotel->update(['password'=>Hash::make($req->new_pass)]);

        return $this->sendResponse('','Password updated successfully');
     }
     else{
        return $this->sendError('There was an error please try again later');
    }


}

public function requestactivation(){
         $hotel=Hotel::find(Auth::user()->id);
          $hotel->rooms()->count();

        if($hotel->active == 0 && $hotel->rooms()->count() >= 5){
            $admin=Admin::select('email')->get();

            Mail::to($admin)->send(new RequestActivationMail($hotel->email,$hotel->id));

            return $this->sendResponse($hotel,'Request sented');
        }else{
            return $this->sendError('You did not added any rooms yet');
        }

    }
}
