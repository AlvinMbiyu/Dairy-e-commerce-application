<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivestocktypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livestocktype', function (Blueprint $table) {
            $table->unsignedInteger('Fid');
            $table->unsignedInteger('Lid');
            $table->string('Type');
            $table->unsignedInteger('Amount_each');
            $table->unsignedInteger('Quantity');

            $table->foreign('Fid')->references('Plot_No')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livestocktype');
    }
}
