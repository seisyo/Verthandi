<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class DiaryPagePermissionMiddleWare
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
        if (in_array((int)Session::get('user')->permission, [1, 2, 3])) {
            return $next($request);
        } else {
            Session::flash('toast_message', ['type' => 'warning', 'content' => '此帳號無權限無法對「日記簿」操作']);
            return redirect()->route('index');
        }
    }
}
