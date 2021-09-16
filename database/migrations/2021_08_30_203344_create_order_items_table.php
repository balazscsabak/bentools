<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('name');
            $table->string('quantity');
            $table->integer('price_sum');
            $table->integer('price_per_item');
            $table->integer('variant_id');
            $table->integer('product_id');
            $table->string('sku');
            $table->string('attr')->default('[]');
            $table->string('attr_values')->default('[]');

            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
