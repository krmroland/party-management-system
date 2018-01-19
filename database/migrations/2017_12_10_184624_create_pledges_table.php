<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePledgesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pledges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact');
            $table->timestamp('date');
            $table->string('name');
            $table->boolean('isCash');
            $table->integer('qty')->unsigned();
            $table->integer('unitCost')->unsigned();
            $table->integer('total')->unsigned();
            $table->string('units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pledges');
    }
}
