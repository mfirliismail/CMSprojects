<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function __construct(private $data  = [],private $message = 'Success',private $status = 200)
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
            'data' => $this->data,
            'message' => $this->message,
            'status' => $this->status,
        ];
    }
}
