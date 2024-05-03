<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $roles)
    {
        $allowedRoles = explode(',', $roles);
        $user = Auth::user();

        if (!in_array($user->role, $allowedRoles)) {
            return redirect('/home')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
