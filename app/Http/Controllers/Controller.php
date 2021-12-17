<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseJSON($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    public function errorJSON($message, $status = 500)
    {
        return $this->responseJSON([
            'message' => $message,
            'status_code' => $status
        ], $status);
    }

    public function successJSON($data = NULL, $status = 200)
    {
        $return = [];
        if ($data != null) {
            if (is_array($data)) {
                $return = $data;
            } else {
                $return['data'] = $data;
            }
        }

        $return['status_code'] = $status;

        return $this->responseJSON($return, $status);
    }

    public function dataJSON($data, $status = 200, $message = NULL)
    {
        return response()->json([
            'data' => $data,
            'response' => 'success',
            'status_code' => $status,
            'message' => $message
        ], $status);
    }
}
