<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleVerification
{

    // private $roleName;

    // public function __construct($roleName){
    //     $this->roleName = $roleName;
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roleNames): Response
    {
        $user = Auth::user();
        if(!in_array($user->role, $roleNames)){
            abort(403, 'Anda tidak memiliki role yang sesuai untuk halaman yang dituju');
        }

        return $next($request);
    }
}
