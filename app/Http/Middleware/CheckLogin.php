<?php
/**
 * Created By PhpStorm
 * Date 2019-7-15
 * Time 15:08
 * Name 马哥
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
/**
 * Class CheckLogin
 * @package App\Http\Middleware
 */
class CheckLogin
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

        $username = $request -> session() -> get('username');         //获取用户昵称

        if(empty($username)){

            return redirect() -> to("/home/login");

        }

        return $next($request);
    }
}
