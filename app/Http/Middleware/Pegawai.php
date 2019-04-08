<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Pegawai
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role=='pegawai'){
            return $next($request);
        }elseif (Auth::check() && Auth::user()->role=='siswa'){
            return redirect()->route('siswa.index');
        }elseif (Auth::check() && Auth::user()->role=='admin'){
            return redirect()->route('admin.index');
        }
    }
}
