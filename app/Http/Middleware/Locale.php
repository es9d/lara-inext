<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;
use Session;
class Locale
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
        $locale = Auth::User()->getSetting('locale');
        App::setLocale($locale);
        return $next($request);
    }
}
