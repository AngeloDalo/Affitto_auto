<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_vehicle', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')
                ->references('id')
                ->on('devices');

            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')
                ->references('id')
                ->on('vehicles');

            $table->primary(['device_id', 'vehicle_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_vehicle');
    }
};
