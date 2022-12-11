<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class EmailIsVerified
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
        // dd($request->id);
        // recup dans l'url l'id => pour vérifier si l'id existe dans la db
        $user = User::find($request->id);
        if($user->email_verified_at != "0")
        {
            return $next($request);
        }
        else
        {
            return Response("Email is not verified", 404);
        }
    }
}