<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->is('admin') || $request->is('admin/*') || $request->is('owner/*')) {
                return route('admin.login');
            }
            return route('user.loginPage');
        }
        if (!auth()->user()->status) {
            if ($request->is('admin') || $request->is('admin/*') || $request->is('owner/*')) {
                return route('admin.login');
            }
            return redirect(route('user.loginPage'));
        }
    }
}
