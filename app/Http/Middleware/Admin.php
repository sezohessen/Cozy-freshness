<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = auth()->user();
        if(Auth::user()){
            if($user->admin == 1) {
                return $next($request);
            }else {
                return redirect()->route('Ecommerce');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
