<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Admin
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
        $user = User::find(session('user')->id);
        $user->admin();
        if($user->admin()){
            return $next($request);
        } else {
            return redirect(route('dashboard'));
        }
    }
}
