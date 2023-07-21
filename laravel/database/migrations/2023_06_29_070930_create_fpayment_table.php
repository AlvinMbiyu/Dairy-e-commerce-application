<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpayment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MCid');
            $table->unsignedBigInteger('pid');
            $table->unsignedBigInteger('Gid');
<<<<<<< HEAD
            $table->boolean('payment_confirmation')->nullable();
=======
            $table->string('payment_confirmation')->nullable();//bool change
>>>>>>> d30721dbf7a66b5435cc52c1269da303e11d519f

            $table->foreign('pid')->references('id')->on('payment');
            $table->foreign('Gid')->references('id')->on('farmergroups');
            $table->foreign('MCid')->references('id')->on('milk_collection');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpayment');
    }
}
