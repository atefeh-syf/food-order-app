<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodFoodMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_food_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('food_menu_id')->unsigned()->index();
            $table->bigInteger('food_id')->unsigned()->index();

            $table->foreign('food_menu_id')->references('id')->on('food_menus');
            $table->foreign('food_id')->references('id')->on('foods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_food_menus');
    }
}
