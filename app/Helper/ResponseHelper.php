<?php

namespace App\Helper;

class ResponseHelper
{
    public static function ok($status, $data)
    {
        $resp = array(
            "status" => $status,
            "data" => $data,
            "statusCode" => 200
        );
        return response()->json($resp);
    }
    
    public static function invalid($status, $data)
    {
        $resp = array(
            "status" => $status,
            "data" => $data,
            "statusCode" => 202
        );
        return response()->json($resp, 202);
    }

    public static function badRequest($status, $data)
    {
        $resp = array(
            "status" => $status,
            "data" => $data,
            "statusCode" => 400
        );
        return response()->json($resp, 400);
    }

    public static function unauthenticated($status, $data)
    {
        $resp = array(
            "status" => $status,
            "data" => $data,
            "statusCode" => 401
        );
        return response()->json($resp, 401);
    }

    public static function unauthorized($status, $data)
    {
        $resp = array(
            "status" => $status,
            "data" => $data,
            "statusCode" => 403
        );
        return response()->json($resp, 403);
    }

    public static function notFound($status, $data)
    {
        $resp = array(
            "status" => $status,
            "data" => $data,
            "statusCode" => 404
        );
        return response()->json($resp, 404);
    }
}