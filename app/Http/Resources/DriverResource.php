<?php

namespace App\Http\Resources;

class DriverResource extends BaseResource
{
    protected function resourceData($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'license_number' => $this->license_number,
            'phone_number' => $this->phone_number,
            'vehicles' => $this->vehicles,
        ];
    }
}