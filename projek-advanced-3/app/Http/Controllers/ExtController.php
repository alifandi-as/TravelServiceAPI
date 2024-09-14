<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtController extends Controller
{
    protected function send_success($data = null){
        return response()->json($data, 200);
    }
    protected function send_bad_request($message = "400 Bad Request"){
        return response()->json($message, 400);
    }
    protected function send_unauthorized($message = "401 Unauthorized"){
        return response()->json($message, 401);
    }
    protected function send_forbidden($message = "403 Forbidden"){
        return response()->json($message, 403);
    }
    protected function send_404($message = "404 Not Found"){
        return response()->json($message, 404);
    }
    protected function send_fail($message = "422 Unprocessable Content (Failed)", $reason = "N/A"){
        return response()->json($message . "<br>" . "Reason: $reason", 404);
    }
}
