<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Gid');
            $table->unsignedInteger('Rid');
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedInteger('total_price');
<<<<<<< HEAD
            $table->boolean('payment_confirmation')->nullable();
=======
            $table->string('payment_confirmation')->nullable();//bool change
>>>>>>> d30721dbf7a66b5435cc52c1269da303e11d519f
            $table->timestamps();

            $table->foreign('Rid')->references('Rid')->on('_retailers');
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
        Schema::dropIfExists('payment');
    }
}
