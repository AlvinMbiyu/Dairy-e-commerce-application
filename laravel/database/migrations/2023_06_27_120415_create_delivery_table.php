<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Gid');
            $table->unsignedBigInteger('RRid');
            $table->unsignedBigInteger('dppid');
            $table->unsignedInteger('amount_delivered');
            $table->boolean('delivery_confirmation');
            $table->timestamps();

            $table->foreign('dppid')->references('id')->on('dppricing');
            $table->foreign('RRid')->references('id')->on('_rrequests');
            $table->foreign('Gid')->references('id')->on('farmergroups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery');
    }
}
