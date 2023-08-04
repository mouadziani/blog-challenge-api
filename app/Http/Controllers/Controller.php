<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($responseData = null, int $statusCode = 200, $headers = [], $options = 0)
    {
        $data = is_array($responseData) ? $responseData : ($responseData ?: [
            'message' => 'Success',
        ]);

        return response()->json($data, $responseData === '' ? 204 : $statusCode, $headers, $options);
    }
}
