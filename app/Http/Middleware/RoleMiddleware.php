<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        // Convert the comma-separated roles into an array
        $rolesArray = explode(',', $roles);

        // Trim any spaces from the roles
        $rolesArray = array_map('trim', $rolesArray);

        // Check if the user's role is in the allowed roles array
        if (!in_array(auth()->user()?->role->role_name, $rolesArray)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
