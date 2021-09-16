<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('shipping_postcode');
            $table->string('shipping_city');
            $table->string('shipping_street');
            $table->string('shipping_county');
            $table->string('billing_postcode');
            $table->string('billing_city');
            $table->string('billing_street');
            $table->string('billing_county');

            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_info');
    }
}
