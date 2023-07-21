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
            $table->boolean('response')->nullable();
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
