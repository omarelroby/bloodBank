<?php

use Illuminate\Support\Facades\Auth;


 function apiResponse($status,$message,$data=null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    //The response: function creates a response instance or obtains an instance of the response factory:
    //The json :method will automatically set the Content-Type header to application/json:
    return response()->json($response);

}

