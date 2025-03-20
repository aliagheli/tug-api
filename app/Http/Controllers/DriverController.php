<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Resources\DriverCollectionResource;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Drivers",
 *     description="API Endpoints for managing drivers"
 * )
 */
class DriverController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/drivers",
     *     tags={"Drivers"},
     *     summary="Retrieve a list of all drivers",
     *     @OA\Response(
     *         response=200,
     *         description="List of drivers",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/DriverResource"))
     *         )
     *     )
     * )
     */

    public function index(): DriverCollectionResource
    {
        return new DriverCollectionResource(Driver::with('vehicles')->get());
    }

    /**
     * Create a new driver.
     *
     * @OA\Post(
     *     path="/api/drivers",
     *     tags={"Drivers"},
     *     summary="Create a new driver",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "license_number", "phone_number"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="license_number", type="string", example="ABC12345"),
     *             @OA\Property(property="phone_number", type="string", example="+1234567890")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Driver created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/DriverResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource")
     *     )
     * )
     */

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->all());
        return new DriverResource($driver, 201);
    }

}
