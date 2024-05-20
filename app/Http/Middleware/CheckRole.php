<?php

namespace App\Http\Middleware;

use App\Models\RoleModel;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user && isset($user->id_role)) {
                $userRole = $user->id_role;

                $roleName = $this->getRoleName($userRole);

                if ($this->checkUserRole($roleName, $roles)) {
                    return $next($request);
                }
            }
        }

        return redirect('/');
    }

    private function getRoleName($roleId)
    {
        $role = RoleModel::find($roleId);
        return $role ? $role->role : null;
    }

    private function checkUserRole($userRole, $roles)
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        return in_array($userRole, $roles);
    }
}
