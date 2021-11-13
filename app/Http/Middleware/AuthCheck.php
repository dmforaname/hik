<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $user = $user->with('roles')->first();

        if ($user) {

            if ($user->role){

                $accessToken =  $user->createToken("token")->accessToken;
                $redirectTo = \Request::getRequestUri();
                return redirect(config('app.url')."/loggedin?token=". $accessToken. '&url=' .$redirectTo);
            }   

            return $next($request);
        }

        return redirect(config('app.url')."/loggedout");
    }
}
