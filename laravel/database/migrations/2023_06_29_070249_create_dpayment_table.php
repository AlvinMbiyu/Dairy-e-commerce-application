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
<<<<<<< HEAD
            $table->boolean('payment_confirmation')->nullable();

=======
            $table->string('payment_confirmation')->nullable();
                    //inclusion of payment_id attribute as foreign key in this table
>>>>>>> d30721dbf7a66b5435cc52c1269da303e11d519f
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
