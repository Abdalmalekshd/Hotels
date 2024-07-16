<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends ResponseController
{


    public function adminsignin(Request $request){
        if(auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            $token = auth('admin')->user()->createToken('MyApp')->accessToken;

            return $this->sendResponse($token,'Logged In');
        }
        return $this->sendError('Please Check Your Data');

    }




    public function adminlogout(){
        Auth::user()->token()->revoke();


        return $this->sendResponse('','Logged out');

    }
}
