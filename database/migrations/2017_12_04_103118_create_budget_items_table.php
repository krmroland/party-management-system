<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_items', function (Blueprint $table) {
            $table->string("name");
            $table->integer("qty")->unsigned()->nullable();
            $table->integer("unitCost")->unsigned()->nullable();
            $table->string("qtyUnits")->nullable();
            $table->integer("total")->unsigned();
            $table->integer("budget_category_id")->unsigned()->index();
            $table->boolean("isCovered")->default(false);
            $table->text("remarks")->nullable();
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
        Schema::dropIfExists('budget_items');
    }
}
