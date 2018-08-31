<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle()
    {
        // If the authenticated user is not an admin (not = to 1), then redirect back to home page
            return redirect('/');
        
        
    }
}
