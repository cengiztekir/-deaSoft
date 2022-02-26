<?php

namespace App\Exceptions;

use App\Helpers\ApiResponse;
use Exception;

class CustomException extends Exception
{
    protected $message;
    protected $status;
    protected $errors;

    public function __construct($message, $status = 406, $errors = [])
    {
        $this->message = $message;
        $this->status = $status;
        $this->errors = $errors;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return ApiResponse::exception($this->status, $this->message, $this->errors);
    }


    /**
     * @return array|mixed
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
