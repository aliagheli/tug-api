<?php

namespace App\Http\Resources;


class VehicleResource extends BaseResource
{
    protected function resourceData($request): array
    {
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'driver' => $this->driver ? new DriverResource($this->driver) : null,
        ];
    }
}
