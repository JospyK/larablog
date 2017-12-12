<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class HasAnyRoleMiddleware
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
        //1. should be authenticated
        //2. should be an admin or manager
        if (Sentinel::check()){   
          if(Sentinel::getUser()->roles()->first()->slug == 'admin' || Sentinel::getUser()->roles()->first()->slug =='manager')
            return $next($request);
          else
            return redirect("/");
        }
        else
            return redirect("/");
    } 
}
