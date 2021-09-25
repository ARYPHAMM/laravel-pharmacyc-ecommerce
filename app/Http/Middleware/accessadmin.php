<?php

namespace App\Http\Middleware;

use Closure;

class accessadmin
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
     
        if ($request->cookie('admin') == null) {
            
            return redirect()->route('user-login');
        } else {
            return $next($request);
        }
        // if($request->is('admin/user/*')){
        //     return $next($request);
        // }else{
        //     return redirect('/');
        // }

    }
}