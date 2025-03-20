<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{

    public function __construct(
        Model       $resource,
        private int $status = 200,
    ) {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        parent::toArray($request);

        return [
            'success' => true,
            'data' => $this->resourceData($request),
        ];
    }

    protected function resourceData($request): array
    {
        return [];
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        $response->setStatusCode($this->status);
    }
}
