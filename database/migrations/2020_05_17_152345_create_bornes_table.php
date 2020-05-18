<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBornesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bornes', function (Blueprint $table) {
            $table->id();
            $table->string('power');
            $table->integer('num_borne');
            $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bornes');
    }
}
