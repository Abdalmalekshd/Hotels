<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if(!$request->expectsJson()){
            if($request->is('Hotels/admin*')){
        return route('admin.login');
    }elseif($request->is('Hotels/user*')){
        return route('user.login');

    }else{
        return route('login');

    }

    }
    }
}