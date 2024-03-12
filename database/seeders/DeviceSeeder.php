<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devices = [
            'gps',
            'monitor',
            'temperatura',
            'supporto',
            'aria',
            'riscaldamento',
        ];

        foreach ($devices as $device) {
            $newDevice = new Device();
            $newDevice->name = $device;
            $newDevice->save();
        }
    }
}
