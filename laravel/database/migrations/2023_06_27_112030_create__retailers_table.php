<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_retailers', function (Blueprint $table) {
            $table->unsignedInteger('Rid');
            $table->string('Name');
            $table->string('BName');
            $table->unsignedInteger('county_id');
            $table->unsignedInteger('sc_id');
            $table->unsignedInteger('town_id');
            $table->unsignedInteger('Phone_no');
            $table->string('email');
            $table->unsignedInteger('age');
            $table->string('password');

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
        Schema::dropIfExists('_retailers');
    }
}
