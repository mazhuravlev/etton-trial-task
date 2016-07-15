<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')
                ->foreign('order_item_order_fk')
                ->references('id')
                ->on('orders');
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
        Schema::drop('order_items');
    }
}
