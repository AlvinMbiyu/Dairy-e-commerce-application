<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_delivery_person', function (Blueprint $table) {
            $table->unsignedInteger('Did');
            $table->string('Name');
            $table->unsignedInteger('county_id');
            $table->unsignedInteger('sc_id');
            $table->unsignedInteger('town_id');
            $table->unsignedInteger('Phone_no');
            $table->string('email');
            $table->unsignedInteger('age');
            $table->string('password');
            $table->string('Op_vehicle');
            $table->string('vehicle_no');

            $table->foreign('county_id')->references('id')->on('county');
            $table->foreign('sc_id')->references('id')->on('subcounty');
            $table->foreign('town_id')->references('id')->on('towns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_delivery_person');
    }
}
