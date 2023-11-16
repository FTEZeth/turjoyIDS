<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectOnRefresh
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('refreshed')) {
            //dd('ENTRO AL IF');
            //dd(session('refreshed'));
            $request->session()->forget('refreshed');
            return redirect('/');
        }

        //dd('NO ENTRO AL IF');
        //dd(session('refreshed'));
        $request->session()->put('refreshed', true);

        return $next($request);
    }
}
