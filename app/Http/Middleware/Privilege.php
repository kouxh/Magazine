<?php

namespace App\Http\Middleware;

use App\Model\AuthorityModel;
use Closure;
use Illuminate\Support\Facades\DB;
use http\Env\Request;
use App\Model\RoleModel;

class Privilege
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
        $username = $request -> session() -> get('username');         //获取用户
        //echo $username;
        $path = $request -> path();                                        //获取路径

        if(self::check_privilege($username -> id , $path) === false){

            return redirect() -> to("/home/403");
        }
        return $next($request);
    }

    /**
     * 检查权限
     * @param Request $request
     * @return mixed
     */
    private function check_privilege($id , $path)
    {

        $path = substr($path , 0 ,strrpos($path , '/'));

        $role = RoleModel::getRole($id);

        $role_id = explode( ',' , $role -> role_id );

        $role = DB::table('mz_role') -> whereIn('id' , $role_id) -> get();

        $data = [];
        foreach ($role as $v){
            $data[] = $v -> role_url;
        }

        if(in_array($path , $data)){
           return true;
        }else{
           return false;
        }
    }
}
