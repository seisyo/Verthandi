<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginCheckMiddleware
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
        if(Session::has('user') === true){
            return $next($request);

        }else{
            Session::flash('message', '請登入');
            return redirect('/login');
        }
        
    }
}
