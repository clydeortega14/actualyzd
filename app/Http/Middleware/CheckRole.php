<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $user = $request->user();

        if($user->hasRole('psychologist')){

            return redirect()->route('psychologist.home');
        }

        if($user->hasRole('member')){

            return redirect()->route('member.home');
        }

        
        return $next($request);
    }
}
