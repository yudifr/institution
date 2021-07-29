<?php namespace App\Http\Middleware;

use Closure;
use App\Helper\ResponseHelper;
class ApiAccess {

    public function handle($request, Closure $next)
    {
        if($request->hasHeader('app-origins')){

            return $next($request);
        }
        else{
            $message = array(
                "message" => "Direct Access Not Allowed"
            );
            return ResponseHelper::invalid("error", $message);

        }
    }
}