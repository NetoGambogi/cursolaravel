<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hasSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // checa se o usuario tem inscricao
        if(!auth()->user()->subscribed(config('services.stripe.product_id'))){
            return redirect()->route('plans');
        };

        return $next($request);
    }
}
