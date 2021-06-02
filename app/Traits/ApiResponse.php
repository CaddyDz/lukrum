<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * @param $data
     * @param null $message
     * @param int $code
     * @param null $paginationInfo (array)
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successApiResponse($data, $message = null, $code = 200, $paginationInfo = null)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        if ($paginationInfo)
            $response = array_merge($response, $paginationInfo);
        return response()->json($response, $code);
    }

    protected function errorApiResponse($message = null, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null
        ], $code);
    }
}
