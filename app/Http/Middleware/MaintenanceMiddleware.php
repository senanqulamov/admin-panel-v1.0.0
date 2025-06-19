<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {



        if(setting('maintenance') == 1){

            if(Auth::id()){
                return $next($request);
            }else{

                return response()->view('frontend.maintenance.index');


            }
        }


        return $next($request);
    }
}
