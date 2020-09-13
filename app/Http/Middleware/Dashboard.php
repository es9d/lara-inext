<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Dashboard
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Company based preferences
        share([
            'company_currency' => $currentCompany->currency,
        ]);
 
        // Share Current Company with All Blade Views
        view()->share('currentCompany', $currentCompany);
        view()->share('authUser', $user);

        return $next($request);
    }
}
