<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthCodeException extends Exception
{
    protected $code = 401;

    protected $message = 'Auth Code exception';

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
     *      schema="AuthCodeException",
     *      example={
     *          "status": "401",
     *          "message": "Auth Code Empty",
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
