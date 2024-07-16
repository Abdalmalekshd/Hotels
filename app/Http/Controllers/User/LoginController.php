<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function signup(){
        return view('User.signup');
     }


     public function usersignup(UserRequest $request){

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'gender'  =>$request->gender,
            'phone'    =>$request->phone,

        ]);


        return redirect()->route('home')->with(['success' => 'You are regestired']);

     }


    public function login(){
       return view('User.signup');
    }


    public function forgetpass(){
        return view('User.forgetpassword');
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

    public function Resetpassword($email){
       $user= User::where('email',$email)->first();

        return view('User.Resetpassword',compact('user'));

    }

    public function Resetpass(Request $request){
        $user=User::where('email',$request->email)->first();


        if($user){
        $user->update([
                            'password'=>Hash::Make($request->pass),
                        ]);


       return redirect()->back()->with(['success'=>'Password succefully reseted']);

    }else{
        return redirect()->back()->with(['error'=>'This Email Does/nt Exists']);

    }



    }



    public function userlogin(Request $request){
        if(auth()->guard('web')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->intended(route('home'));
        }
        return redirect()->back()->withInput($request->only('email'));
    }




    public function userlogout(){
        auth('web')->logout();

        return redirect()->route('user.login');

    }
}