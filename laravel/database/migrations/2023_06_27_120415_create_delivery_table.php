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
            $table->increments('delivery_id');
            $table->increments('Gid');
            $table->unsignedInteger('Rid');
            $table->unsignedInteger('Did');
            $table->unsignedInteger('amount_delivered');
            $table->unsignedInteger('price_per_litre');
            $table->unsignedInteger('total_price');
            $table->string('delivery_confirmation');
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
        Schema::dropIfExists('delivery');
    }
}
