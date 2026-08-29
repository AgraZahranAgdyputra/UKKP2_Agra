<?php

namespace App\Http\Middleware;

use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Usage: middleware('permission:feature,ability')
     * e.g. 'permission:users,can_view'
     */
    public function handle(Request $request, Closure $next, string $feature, string $ability = 'can_view')
    {
        $user = $request->user();

        if (! $user || ! RolePermission::allowed($user->role, $feature, $ability)) {
            abort(403, 'Anda tidak memiliki akses ke fitur ini.');
        }

        return $next($request);
    }
}
