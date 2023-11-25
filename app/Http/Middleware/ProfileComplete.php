<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileComplete
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
        if ($request->user() && !$request->user()->profile_complete) {
            return redirect()->route('edit-user', $request->user()->id)->with('warning', 'Lengkapi Profil Anda Terlebih Dahulu');
        }
        return $next($request);
    }
}
