<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->unsignedInteger('Fid');
            $table->string('Name');
            $table->unsignedInteger('county_id');
            $table->unsignedInteger('sc_id');
            $table->unsignedInteger('town_id');
            $table->string('Phone_no');
            $table->string('email');
            $table->unsignedInteger('age');
            $table->string('password');
            $table->unsignedBigInteger('Gid')->nullable();

            $table->primary('Fid');
            $table->foreign('Gid')->references('id')->on('farmergroups')->onDelete('cascade');
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
        Schema::dropIfExists('farmers');
    }
}
