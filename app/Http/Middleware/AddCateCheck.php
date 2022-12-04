<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddCateCheck
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
            'category_name' => 'required|unique:categories|max:100',

        ],
        [
            'category_name.required' => 'Please Input Category Name',
        ]);

        return $next($request);
    }
}
