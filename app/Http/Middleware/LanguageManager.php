<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Adrianorosa\GeoLocation\GeoLocation;

class LanguageManager
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


        // Taiwan
        // China
        // HK, Taiwan and China IP as Chinese
        // dd($details);

        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        } else {

            $details = GeoLocation::lookup($request->ip());
            $locations = ['Taiwan', 'Chinese', 'Hong Kong'];

            if (in_array($details->getCountry(), $locations) || in_array($details->getCity(), $locations) || in_array($details->getRegion(), $locations)) {
                App::setLocale('ch');
            }
        }

        return $next($request);
    }
}
