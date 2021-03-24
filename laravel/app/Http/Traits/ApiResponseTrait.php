<?php

namespace App\Http\Traits;

trait ApiResponseTrait {
    protected function trJsonError($code, $message = 'Error') {
        return response()->json([
            "error" => [
                "code" => $code,
                "message" => $message
            ]
        ], $code);
    }

    protected function trJsonErrorForm($errorField, $code, $message = 'Error') {
        return response()->json([
            "error" => [
                "code" => $code,
                "message" => $message
            ],
            "validations" => $errorField
        ], $code);
    }

    protected function trJsonSuccess($data, $code = 200, $message = 'Success') {
        $data['message'] = $message;

        return response()->json(
            empty($data) ? null : $data
        , $code);
    }
}
