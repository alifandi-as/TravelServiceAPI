<?php

namespace App\Http\Controllers;

class ExtApiController extends Controller
{
    protected function send_success($message, $data = null){
        return response()->json([
            "code" => 200,
            "message" => $message,
            "data" => $data], 200);
    }
    protected function send_bad_request($message = "Bad Request"){
        return response()->json([
            "code" => 400,
            "message" => $message], 400);
    }
    protected function send_unauthorized($message = "Unauthorized"){
        return response()->json([
            "code" => 401,
            "message" => $message], 401);
    }
    protected function send_forbidden($message = "Forbidden"){
        return response()->json([
            "code" => 403,
            "message" => $message], 403);
    }
    protected function send_404($message = "Not Found"){
        return response()->json([
            "code" => 404,
            "message" => $message], 404);
    }
    protected function send_fail($message, $reason = null){
        return response()->json([
            "code" => 422,
            "message" => $message,
            "reason" => $reason], 422);
    }
}
