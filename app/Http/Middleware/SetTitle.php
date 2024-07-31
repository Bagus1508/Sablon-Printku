<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTitle
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (method_exists($response, 'getContent')) {
            $content = $response->getContent();
            preg_match('/<title>(.*)<\/title>/', $content, $matches);
            if (isset($matches[1])) {
                $title = $matches[1];
                $response->headers->set('X-Title', $title);
            }
        }

        return $response;
    }
}
