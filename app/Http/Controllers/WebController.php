<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class WebController extends Controller
{

        /**
     * return success response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccess($result,$message,$status_code = 200)
    {
        $response = [
            'success'     => true,
            'status_code' => $status_code,
            'message'     => $message,
            'result'      => $result,
        ];
        return response()->json($response, $status_code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $error_code = 404)
    {
       
        $response = [
            'success'     => false,
            'status_code' => (int)$error_code,
            'message'     => $error,
        ];
     
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, (int)$error_code);
    }

    
}
