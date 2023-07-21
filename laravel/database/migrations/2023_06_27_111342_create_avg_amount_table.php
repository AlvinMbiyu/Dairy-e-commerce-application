<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvgAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avg_amount', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Fid');
            $table->unsignedInteger('Total_avg_Amount');
            $table->unsignedInteger('No_of_liv');

            $table->foreign('Fid')->references('Fid')->on('farmers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avg_amount');
    }
}
