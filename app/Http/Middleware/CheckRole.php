<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $user = auth()->guard('user')->user()) :
            return redirect()->route('login')->with('errMsg', trans('please_login'));
        endif;

        if (! in_array($user->role, ['ADMIN', 'MANAGER'])) :
            return redirect()->route('home')->with('msg', trans('not_authorized'));
        endif;

        return $next($request);
    }
}
