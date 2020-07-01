<?php

namespace App\Traits;

trait ResponseTrait
{
    public function success($data = [], $code = 0, $message = "success")
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    public function failure($data = [], $code = 500, $message = "failure")
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ]);
    }

}

