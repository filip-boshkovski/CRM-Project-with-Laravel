<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request was succesful',
            'message' => $message,
            'date' => $data
        ], $code);
    }

    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'Error has occured',
            'message' => $message,
            'date' => $data
        ], $code);
    }
}
