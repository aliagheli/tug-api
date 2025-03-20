<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Driver::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'license_number' => 'required|unique:drivers',
            'phone_number' => 'required|string',
        ]);

        $driver = Driver::create($request->all());

        return response()->json($driver, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
