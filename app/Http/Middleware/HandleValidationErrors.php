<?php

// app/Http/Middleware/HandleValidationErrors.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class HandleValidationErrors
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->session()->has('errors')) {
            $errors = $request->session()->get('errors')->all();
            Session::flash('validation_errors', $errors);
        }

        return $response;
    }
}

