<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected function successResponse($data, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse(string $message = 'Error', int $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    protected function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, 404);
    }

    protected function validationErrorResponse($errors): JsonResponse
    {
        return $this->errorResponse('Validation error', 422, $errors);
    }
}