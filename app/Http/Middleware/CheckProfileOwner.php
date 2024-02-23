<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userModel = User::where('username', $request->route('username'))->first();

        if (!$userModel || !auth()->check() || (auth()->user()->id !== $userModel->id && auth()->user()->role !== 'admin')) {
            abort(403);
        }

        return $next($request);
    }
}
