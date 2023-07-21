<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_rrequests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Rid');
            $table->unsignedBigInteger('Gid');
            $table->unsignedInteger('demand_required');
<<<<<<< HEAD
            $table->boolean('response')->nullable();
=======
            $table->string('response');//change datatype to bool
>>>>>>> d30721dbf7a66b5435cc52c1269da303e11d519f
            $table->timestamps();

            $table->foreign('Rid')->references('Rid')->on('_retailers');
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
        Schema::dropIfExists('_rrequests');
    }
}
