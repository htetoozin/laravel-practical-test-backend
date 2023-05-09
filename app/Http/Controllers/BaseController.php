<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    /**
    * Success response for API
    * 
    * @param $data, $code
    * @return json 
    */
    public function responseSuccess($data, $code = 200)
    {
        if(is_object($data))
        {
            $response['data'] = $data;
            return response()->json($response, $code);
        }

        if(is_array($data)){
            return response()->json($data, $code);
        }
      
        return response()->json(['data' => $data], $code);
    }

    /**
    * Error response for API
    * 
    * @param $message, $code
    * @return json 
    */
    public function responseError($message, $code = 422)
    {
        $response = [
            'code' => $code,
            'status' => 'failed',
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
