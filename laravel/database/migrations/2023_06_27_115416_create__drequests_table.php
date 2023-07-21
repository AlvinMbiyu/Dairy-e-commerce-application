<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_drequests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Did');
            $table->unsignedBigInteger('Gid');
            $table->unsignedInteger('est_amount');
<<<<<<< HEAD
            $table->boolean('response')->nullable();
=======
            $table->string('response');//change to bool
>>>>>>> d30721dbf7a66b5435cc52c1269da303e11d519f
            $table->timestamps();

            $table->foreign('Gid')->references('id')->on('farmergroups');
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
        Schema::dropIfExists('_drequests');
    }
}
