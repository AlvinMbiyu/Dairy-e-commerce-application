<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->unsignedInteger('Fid');
            $table->string('Name');
            $table->string('Address');
            $table->unsignedInteger('Phone_no');
            $table->string('email');
            $table->unsignedInteger('age');
            $table->string('password');
            $table->unsignedInteger('Gid')->nullable();

            $table->foreign('Gid')->references('Gid')->on('farmer__groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmers');
    }
}
