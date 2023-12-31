<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpayment', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Did');
            $table->unsignedBigInteger('Gid');
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedInteger('total_dprice');
            $table->boolean('payment_confirmation')->nullable();

            $table->foreign('Did')->references('Did')->on('_delivery_person');
            $table->foreign('Gid')->references('id')->on('farmergroups');
            $table->foreign('delivery_id')->references('id')->on('delivery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dpayment');
    }
}
