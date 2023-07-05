<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * @param string $message
     * @param array|JsonResource $payload
     * @param int $status
     * @return JsonResponse
     */
    protected function response(string $message, array|JsonResource $payload = [], int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
                'message' => $message,
            ] + $payload, $status);
    }

    /**
     * Response data
     * @param array|JsonResource $data
     * @param int $status
     * @return JsonResponse
     */
    protected function responseData(array|JsonResource $data = [], int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], $status);
    }

    /**
     * @param string $route
     * @return JsonResponse
     */
    protected function redirect(string $route): JsonResponse
    {
        return response()->json([
            'redirect' => $route,
        ], Response::HTTP_OK);
    }
}