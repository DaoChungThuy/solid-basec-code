<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\User\GetRoleService;
use App\Enums\UserRole;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->check()) {
            return redirect()->route('show_login');
        }

        $requestedUserId = $request->route('id');
        $currentUserId = $request->user()->id;

        if ($requestedUserId == $currentUserId) {
            return $next($request);
        }

        $requestedUserRoles = resolve(GetRoleService::class)->setParams($requestedUserId)->handle();
        $currentUserRoles = resolve(GetRoleService::class)->setParams($currentUserId)->handle();

        foreach ($requestedUserRoles as $requestedUserRole) {
            foreach ($currentUserRoles as $currentUserRole) {
                if (
                    $currentUserRole['id'] == $requestedUserRole['id'] ||
                    $currentUserRole['id'] == UserRole::Staff ||
                    ($currentUserRole['id'] == UserRole::Store && $requestedUserRole['id'] != UserRole::Staff)
                ) {

                    return redirect()->route('show_login');
                }
            }
        }

        return $next($request);
    }
}
