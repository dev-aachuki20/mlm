<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if($role == 'user' && !auth()->user()->is_user){
            abort(403, 'Unauthorized');
        }

        if($role == 'admin' && !auth()->user()->is_super_admin && !auth()->user()->is_admin){
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
