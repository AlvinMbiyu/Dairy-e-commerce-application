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
            $table->increments('MCid');
            $table->increments('Gid');
            $table->unsignedInteger('Fid');
            $table->unsignedInteger('Did');
            $table->unsignedInteger('amount_produced')->nullable();
            $table->string('delivery_confirmation')->nullable();
            $table->timestamps();
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
