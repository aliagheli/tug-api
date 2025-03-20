<?php

namespace App\Http\Resources;


/**
 * @OA\Schema(
 *     schema="DriverResource",
 *     title="Driver Resource",
 *     description="Driver model representation",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="license_number", type="string", example="ABC12345"),
 *     @OA\Property(property="phone_number", type="string", example="+1234567890"),
 *     @OA\Property(property="vehicles", type="array", @OA\Items(ref="#/components/schemas/VehicleResource"))
 * )
 */
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