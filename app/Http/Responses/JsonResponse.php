<?php

namespace App\Http\Responses;

class JsonResponse
{
    public $succeeded;
    public $message;
    public $data;
    public $statusCode;

    public function __construct($succeeded, $message, $data, $statusCode)
    {
        $this->succeeded = $succeeded;
        $this->message = $message;
        $this->data = $data;
        $this->statusCode = $statusCode;
    }
}
