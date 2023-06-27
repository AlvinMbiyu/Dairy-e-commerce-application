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
            $table->increments('dppid');
            $table->unsignedInteger('dpricing');
            $table->unsignedInteger('per_litre')->nullable();
            $table->timestamps();
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
