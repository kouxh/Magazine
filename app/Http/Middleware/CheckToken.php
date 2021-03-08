<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\ApiException;
use App\Http\Controllers\Applets\CheckTokenApi;

class CheckToken
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
        if(!isset($_SERVER['HTTP_TOKEN'])){
            throw new ApiException('参数错误（Token）');
        }
        if(!isset($_SERVER['HTTP_UID'])){
            throw new ApiException('参数错误（UID）');
        }
        $obj = new CheckTokenApi($_SERVER['HTTP_TOKEN'], $_SERVER['HTTP_UID']);
        $obj -> checkToken();

        return $next($request);
    }
}
