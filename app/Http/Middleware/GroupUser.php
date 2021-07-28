<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GroupUser
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
        $user = $request->user();
        if (isset($user) && isset($user->group_user_id)
            && $user->group_user_id == 0) {
            return $next($request);
        }
        abort(403);
    }
}
