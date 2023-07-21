<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDppricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dppricing', function (Blueprint $table) {
            $table->unsignedInteger('Did');
            $table->id();
<<<<<<< HEAD
            $table->unsignedInteger('dpricing');
            $table->boolean('per_litre');
=======
            $table->unsignedInteger('dpricing');//based on standard price you 
            $table->unsignedInteger('per_litre')->nullable();
>>>>>>> d30721dbf7a66b5435cc52c1269da303e11d519f
            $table->timestamps();

            $table->foreign('Did')->references('Did')->on('_delivery_person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dppricing');
    }
}
