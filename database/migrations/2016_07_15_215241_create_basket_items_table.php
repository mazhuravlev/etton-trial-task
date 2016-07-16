<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')
                ->foreign('basket_item_user_fk')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('item_id')
                ->foreign('order_item_item__fk')
                ->references('id')
                ->on('items');
            $table->unsignedTinyInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('basket_items');
    }
}
