<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\jwt as JWT;
class ApiAut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if($token === null)
        {
            return response([
                "status"=> 304,
                "mess" => 'Khong co quyen truy cap',
                "data" => null
            ]);
        }
       
        $jwt = new JWT();
        $get_token = $jwt->is_jwt_valid($jwt->get_bearer_token($token));
        if($get_token["check"])
        {
            $payload = $get_token["payload"];
            return $next($request);
        }else {
            return response([
                "status"=> 304,
                "mess" => 'Khong co quyen truy cap',
                "data" => null
            ]);
        }
        
    }
}
