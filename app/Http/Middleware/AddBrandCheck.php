<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddBrandCheck
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
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:100',
            'brand_image' => 'required',

        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
        ]);
        return $next($request);
    }
}
