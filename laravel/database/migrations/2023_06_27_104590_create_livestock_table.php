<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivestockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livestock', function (Blueprint $table) {
            $table->increments('Lid');
            $table->unsignedInteger('Fid');
            $table->unsignedInteger('Ltid');
            $table->unsignedInteger('Quantity');

            $table->foreign('Fid')->references('Fid')->on('farmers');
            $table->foreign('Ltid')->references('Ltid')->on('Livestocktype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livestock');
    }
}
