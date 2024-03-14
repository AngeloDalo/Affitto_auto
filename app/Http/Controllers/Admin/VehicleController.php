<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Licence;
use App\Models\Driver;
use Prophecy\Call\Call;
use App\Models\Device;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Driver::orderBy('id', 'desc')->paginate(20);
        return view('admin.vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devices = Device::all();
        return view('admin.vehicles.create', ['devices' => $devices]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'color' => 'required',
            'fuel' => 'required',
            'max_weight' => 'required',
            'type' => 'required',
            'devices.*' => 'nullable|exists:App\Device,id',
        ]);

        $vehicle = new Vehicle();
        $vehicle->fil($data);
        $vehicle->save();

        if(!empty($data['devices'])){
            $vehicle->licences()->attach($data['devices']);
        }

        return redirect()->route('admin.vehicles.show', $vehicle->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $devices = Device::all();
        return view('admin.vehicles.edit', ['vehicle' => $vehicle, 'devices' => $devices]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'color' => 'required',
            'fuel' => 'required',
            'max_weight' => 'required',
            'type' => 'required',
            'devices.*' => 'nullable|exists:App\Device,id',
        ]);
        if($data['color'] != $vehicle->color) {
            $vehicle->color = $data['color'];
        }
        if($data['fuel'] != $vehicle->fuel) {
            $vehicle->fuel = $data['fuel'];
        }
        if($data['max_weight'] != $vehicle->max_weight) {
            $vehicle->max_weight = $data['max_weight'];
        }
        if($data['type'] != $vehicle->type) {
            $vehicle->type = $data['type'];
        }

        $vehicle->update();
        if(!empty($data['devices'])){
            $vehicle->licences()->sync($data['devices']);
        } else {
            $vehicle->licences()->detach();
        }
        return redirect()->route('admin.vehicles.show', $vehicle->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
