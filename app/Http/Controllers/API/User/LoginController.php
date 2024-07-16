<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends ResponseController
{


     public function usersignup(UserRequest $request){

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'gender'  =>$request->gender,
            'phone'    =>$request->phone,

        ]);

        $success['token']=$user->createToken('')->accessToken;

        return $this->sendResponse($success,'You are regestired');

     }




     public function userlogin(Request $request){
        if(auth()->guard('web')->attempt(['email'=>$request->email,'password'=>$request->password])){

            $token = auth('web')->user()->createToken('MyApp')->accessToken;

            return $this->sendResponse($token,'Logged In');
        }
        return $this->sendError('Please Check Your Data');
    }




    public function forgetpassword(Request $request){
        $data=[];
        $data['user']=User::where('email',$request->email)->first();

       if($data['user']){


       Mail::send('User.Mail.ResetPassword', $data, function($message) use($data){

           $message->to($data['user']->email)->subject('Reset Password');

       });

       return redirect()->back()->with(['success'=>'Please check your mail']);
       }else{
        return redirect()->back()->with(['error'=>'This Email Does/nt Exists']);
       }

    }






    public function userlogout(){
        auth('web')->logout();

        return redirect()->route('user.login');

    }
}
