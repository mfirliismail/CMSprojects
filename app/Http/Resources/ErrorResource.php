<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public function __construct(private $message,private $status = 500)
    {

    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->status);
        parent::withResponse($request, $response);
    }

    public function toArray(Request $request)
    {
        return [
            'message' => $this->message,
            'status' => $this->status
        ];
    }
}
