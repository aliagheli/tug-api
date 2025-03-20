<?php

namespace App\Http\Resources;


use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="VehicleResource",
 *     title="Vehicle Resource",
 *     description="Vehicle model representation",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="plate_number", type="string", example="ABC123"),
 *     @OA\Property(property="brand", type="string", example="Toyota"),
 *     @OA\Property(property="model", type="string", example="Corolla"),
 *     @OA\Property(property="year", type="integer", example=2022),
 *     @OA\Property(property="driver", ref="#/components/schemas/DriverResource")
 * )
 */
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
