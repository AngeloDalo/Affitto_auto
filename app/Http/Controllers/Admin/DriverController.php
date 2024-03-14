<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Licence;
use App\Models\Driver;
use Prophecy\Call\Call;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::orderBy('name', 'desc')->paginate(20);
        return view('admin.drivers.index', ['drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licences = Licence::all();
        return view('admin.drivers.create', ['licences' => $licences]);
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
            'phone' => 'required',
            'b_day' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'vehicle_id' => 'exists:App\Models\Vehicle,id',
            'licences.*' => 'nullable|exists:App\Licence,id',
        ]);

        $driver = new Driver();
        $driver->fil($data);
        $driver->save();

        if(!empty($data['licences'])){
            $driver->licences()->attach($data['licences']);
        }

        return redirect()->route('admin.drivers.show', $driver->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return view('admin.drivers.show', ['driver' => $driver]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $licences = Licence::all();
        return view('admin.drivers.edit', ['driver' => $driver, 'licences' => $licences]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'phone' => 'required',
            'b_day' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'vehicle_id' => 'exists:App\Models\Vehicle,id',
            'licences.*' => 'nullable|exists:App\Licence,id',
        ]);
        if($data['phone'] != $driver->phone) {
            $driver->phone = $data['phone'];
        }
        if($data['b_day'] != $driver->b_day) {
            $driver->b_day = $data['b_day'];
        }
        if($data['name'] != $driver->name) {
            $driver->name = $data['name'];
        }
        if($data['surname'] != $driver->surname) {
            $driver->surname = $data['surname'];
        }
        if($data['vehicle_id'] != $driver->vehicle_id) {
            $driver->vehicle_id = $data['vehicle_id'];
        }

        $driver->update();
        if(!empty($data['licences'])){
            $driver->licences()->sync($data['licences']);
        } else {
            $driver->licences()->detach();
        }
        return redirect()->route('admin.drivers.show', $driver->id);
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
