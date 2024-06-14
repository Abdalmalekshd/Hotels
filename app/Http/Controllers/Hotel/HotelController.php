<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\Hotels\HotelProfile;
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

class HotelController extends Controller
{

    use UplaodImageTraits;
    public function HotelProfile(){
        $data=[];
         $data['hotel']=Hotel::find(Auth::user()->id);

         $data['rooms']=Room::where('hotel_id',Auth::user()->id)->get();
        return view('Hotel.Profile.index',$data);
    }


    public function EditHotel(){
        $data=[];
         $data['hotel']=Hotel::find(Auth::user()->id);
         $data['attachments']=Attachment::select(['id','name_ar','name_en',
         'name_' . LaravelLocalization::getCurrentLocale() .' as Name',
         ])->where('attachment_level',0)->get();

         return view('Hotel.Profile.edit',$data);

    }

    public function UpdateHotel(HotelProfile $request){

        $hotel=Hotel::find(Auth::user()->id);
        $hotel->update([
        'name'      =>$request->name,
        'email'     =>$request->email,
        'phone'     =>$request->phone,

    ]);

        if($request->hasFile('photo')){

            $des ='images/hotels/' . $hotel->photo;

           if (File::exists($des)) {
                File::delete($des);

       }
            $img=$this->UploadImage('hotels',$request->photo);
       $hotel->photo= $img;

        }

     $hotel->latitude=$request->latitude;
     $hotel->longitude=$request->longitude;



        $hotel->save();

        $hotelAttach=HotelAttachment::where('hotel_id',$hotel->id)->first();
            if($hotelAttach){

                $hotelAttach->update(['attachemnts'=>json_encode($request->attach)]);

            }else{
            $hotelAttach=new HotelAttachment();
            $hotelAttach->hotel_id = $hotel->id;
            $hotelAttach->attachemnts=json_encode($request->attach);
            $hotelAttach->save();
         }

        return redirect()->back()->with(['success'=>'Profile Updated']);


    }



    public function EditHotelPass(){
        $data['hotel']=Hotel::find(Auth::user()->id);
        return view('Hotel.Profile.Editpassword',$data);
    }



    public function UpdateHotelPass(EditPasswordRequest $req){
        $hotel=Hotel::find(Auth::user()->id);

        if(Hash::check($req->old_pass,$hotel->password))
    {

        $hotel->update(['password'=>Hash::make($req->new_pass)]);

        return redirect()->back()->with(['success'=>'Password updated successfully']);
     }
     else{
        return redirect()->back()->with(['erorr'=>'There was an error please try again later']);
    }

    }
    public function requestactivation(){
        $hotel=Hotel::find(Auth::user()->id);


        if($hotel->active == 0 && $hotel->rooms()->count() >= 5){
            $admin=Admin::select('email')->get();

            Mail::to($admin)->send(new RequestActivationMail($hotel->email,$hotel->id));
            return redirect()->back()->with(['success'=>'Request sented']);
        }else{
            return redirect()->back()->with('You did not added any rooms yet');
        }

    }
}