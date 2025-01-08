<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InValidAccessDeviceException extends Exception
{
    protected $code = 401;

    protected $message = 'Invalid access device token';

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
     *      schema="InValidAccessDeviceException",
     *      example={
     *          "status": "401",
     *          "message": "Invalid access device token",
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
