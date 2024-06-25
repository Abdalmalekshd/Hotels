<?php

namespace App\Http\Controllers\API\Hotel;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends ResponseController
{


    public function signin(Request $request){
        if(auth()->guard('hotel')->attempt(['email'=>$request->email,'password'=>$request->password])){

            $token = auth('hotel')->user()->createToken('MyApp')->accessToken;

            return $this->sendResponse($token,'Logged In');
        }
        return $this->sendError('Please Check Your Data');
    }



    public function forgetpassword(Request $request){
        $data=[];
        $data['hotel']=Hotel::where('email',$request->email)->first();

       if($data['hotel']){


       Mail::send('Hotel.Mail.forgetpass', $data, function($message) use($data){

           $message->to($data['hotel']->email)->subject('Reset Password');

       });

       return redirect()->back()->with(['success'=>'Please check your mail']);

       }else{
        return redirect()->back()->with(['error'=>'This Email Does/nt Exists']);
       }

    }

    public function Resetpassword($email){
       $hotel= Hotel::where('email',$email)->first();
        return view('Hotel.Resetpassword',compact('hotel'));

    }

    public function Resetpass(Request $request){
        $hotel=Hotel::where('email',$request->email)->first();


        if($hotel){
        $hotel->update([
                            'password'=>Hash::Make($request->pass),
                        ]);


       return redirect()->back()->with(['success'=>'Password succefully reseted']);

    }else{
        return redirect()->back()->with(['error'=>'This Email Does/nt Exists']);

    }



    }

    public function logout(Request $request){
        auth('hotel')->logout();

        return redirect()->route('login');

    }
}