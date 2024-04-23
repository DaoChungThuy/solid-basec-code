<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Generate JSON response for errors.
     *
     * @param string $message 
     * @param int $statusCode 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function responseErrors($message = '', $statusCode = Response::HTTP_FORBIDDEN)
    {
        return response()->json([
            'code' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Generate JSON response for success.
     *
     * @param array $data
     * @param int $statusCode 
     * @return \Illuminate\Http\JsonResponse 
     */
    public function responseSuccess($data, $statusCode = Response::HTTP_OK)
    {
        return response()->json(
            array_merge(['code' => $statusCode], $data),
            $statusCode
        );
    }
}
