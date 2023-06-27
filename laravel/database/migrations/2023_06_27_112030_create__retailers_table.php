<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_retailers', function (Blueprint $table) {
            $table->unsignedInteger('Rid');
            $table->string('Name');
            $table->string('BName');
            $table->string('BAddress');
            $table->unsignedInteger('Phone_no');
            $table->string('email');
            $table->unsignedInteger('age');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_retailers');
    }
}
