<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollectionResource extends ResourceCollection
{
    public function __construct(
        $resource,
        private int $status = 200,
    ) {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'success' => true,
            'data' => $this->collection,
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->status);
    }
}
