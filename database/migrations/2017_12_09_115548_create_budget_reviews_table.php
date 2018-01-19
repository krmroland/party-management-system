<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetReviewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('budget_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('budget_item_id')->unsigned()->index();
            $table->text('description');
            $table->timestamp('reviewed_at');
            $table->text('before');
            $table->text('after');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('budget_reviews');
    }
}
