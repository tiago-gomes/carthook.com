<?php
/**
 * Created by PhpStorm.
 * User: Tiago Gomes
 * Date: 04/12/2018
 * Time: 15:45
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}