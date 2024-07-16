<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function adminlogin(){
       return view('Admin.login');
    }

    public function adminsignin(Request $request){
        if(auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->intended(route('dashboard'));
        }
        return redirect()->back()->withInput($request->only('email'));
    }




    public function adminlogout(){
        auth('admin')->logout();

        return redirect()->route('admin.login');

    }
}