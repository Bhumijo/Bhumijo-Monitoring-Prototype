<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IdTokenInvalidException extends Exception
{
    protected $code = 404;

    protected $message = 'Invalid Id Token';

    /**
     * Report the exception
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->getMessage());
    }

    /**
     * @OA\Schema(
     *      schema="IdTokenInvalidException",
     *      example={
     *          "status": "401",
     *          "message": "Invalid Token Id",
     *      }
     * )
     *
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function render(Request $request)
    {
        return new JsonResponse([
            'error' => [
                'message' => $this->getMessage(),
            ],
        ], $this->code);
    }
}
