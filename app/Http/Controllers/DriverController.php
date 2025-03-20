<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Resources\DriverCollectionResource;
use App\Http\Resources\DriverResource;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index(): DriverCollectionResource
    {
        return new DriverCollectionResource(Driver::with('vehicles')->get());
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->all());
        return new DriverResource($driver, 201);
    }

}
