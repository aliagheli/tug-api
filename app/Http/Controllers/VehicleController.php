<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignDriverRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\VehicleCollectionResource;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Vehicles",
 *     description="API Endpoints for managing vehicles"
 * )
 */
class VehicleController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/vehicles",
     *     tags={"Vehicles"},
     *     summary="Retrieve a list of all vehicles",
     *     @OA\Response(
     *         response=200,
     *         description="List of vehicles",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/VehicleResource"))
     *         )
     *     )
     * )
     */

    public function index(): VehicleCollectionResource
    {
        return new VehicleCollectionResource(Vehicle::with('driver')->get());
    }

    /**
     * Create a new vehicle.
     *
     * @OA\Post(
     *     path="/api/vehicles",
     *     tags={"Vehicles"},
     *     summary="Create a new vehicle",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"plate_number", "brand", "model", "year"},
     *             @OA\Property(property="plate_number", type="string", example="ABC123"),
     *             @OA\Property(property="brand", type="string", example="Toyota"),
     *             @OA\Property(property="model", type="string", example="Corolla"),
     *             @OA\Property(property="year", type="integer", example=2022)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Vehicle created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/VehicleResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource")
     *     )
     * )
     */

    public function store(StoreVehicleRequest $request): JsonResource
    {
        $vehicle = Vehicle::create($request->all());

        return new VehicleResource(
            resource: $vehicle,
            status: 201,
        );
    }

    /**
     * Assign a driver to a vehicle.
     *
     * @OA\Post(
     *     path="/api/vehicles/{vehicle}/assign-driver",
     *     tags={"Vehicles"},
     *     summary="Assign a driver to a vehicle",
     *     @OA\Parameter(
     *         name="vehicle",
     *         in="path",
     *         required=true,
     *         description="ID of the vehicle",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"driver_id"},
     *             @OA\Property(property="driver_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Driver assigned successfully",
     *         @OA\JsonContent(ref="#/components/schemas/VehicleResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Vehicle not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to assign driver",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource")
     *     )
     * )
     */

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
