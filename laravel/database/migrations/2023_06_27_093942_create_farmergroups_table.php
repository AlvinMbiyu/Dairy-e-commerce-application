<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmergroups', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('price_per_litre')->nullable();
            $table->unsignedInteger('county_id');
            $table->unsignedInteger('sc_id');
            $table->unsignedInteger('town_id');
            $table->timestamps();

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
        Schema::dropIfExists('farmergroups');
    }
}
