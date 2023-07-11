<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_collection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Gid');
            $table->unsignedInteger('Fid');
            $table->unsignedBigInteger('DRid');
            $table->unsignedInteger('amount_produced')->nullable();
            $table->string('pickup_confirmation')->nullable();//bool change
            $table->timestamps();

            $table->foreign('DRid')->references('id')->on('_drequests');
            $table->foreign('Fid')->references('Fid')->on('farmers');
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
        Schema::dropIfExists('milk_collection');
    }
}
