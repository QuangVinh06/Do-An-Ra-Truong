<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập khu vực này');
        }
    $user = Auth::guard('admin')->user();
    $route = $request->route()->getName();
  if ($user->cant($route)) {
        return redirect()->back()->with('error', 'Bạn không có quyền truy cập chức năng này!');
    }
        return $next($request);
    }
    

}
