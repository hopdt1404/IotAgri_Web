<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GroupAdmin
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
            && $user->group_user_id == 1) {
            return $next($request);
        }
        abort(403);

    }
}
