<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignDriverRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\VehicleCollectionResource;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleController extends Controller
{

    public function index(): VehicleCollectionResource
    {
        return new VehicleCollectionResource(Vehicle::with('driver')->get());
    }

    public function store(StoreVehicleRequest $request): JsonResource
    {
        $vehicle = Vehicle::create($request->all());

        return new VehicleResource(
            resource: $vehicle,
            status: 201,
        );
    }

    public function assignDriver(AssignDriverRequest $request, int $vehicle = 0): JsonResource
    {
        $vehicle = Vehicle::find($vehicle);

        if ( ! $vehicle) {
            return new ErrorResource(
                message: 'Vehicle not found',
                status: 404,
            );
        }


        $updated = $vehicle->update([
            'driver_id' => $request->driver_id,
            'updated_at' => now(),
        ]);

        if ( ! $updated) {
            return new ErrorResource(
                message: 'Failed to assign driver',
                status: 500,
            );
        }

        return new VehicleResource($vehicle);
    }

}
