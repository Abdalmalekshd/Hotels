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

       return $this->sendResponse($data,'Please check your mail');

       }else{
        return $this->sendError('This Email Does/nt Exists');
       }

    }






    public function logout(Request $request){
        Auth::user()->token()->revoke();



        return $this->sendResponse('','Logged out');



    }
}
