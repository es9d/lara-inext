<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class CustomerPortal
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
        // Share Current Customer with All Blade Views
        $currentCustomer = Customer::findByUid($request->customer);
        view()->share('currentCustomer', $currentCustomer);

        return $next($request);
    }
}
