<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('stripe_id');
            $table->string('status');
            $table->integer('stripe_amount');
            $table->integer('real_amount');
            $table->string('payment_method_id');
            $table->string('card_holder_name');
            $table->string('customer')->nullable();
            $table->string('receipt_email')->nullable();
            $table->string('stripe_created');
            $table->boolean('paid');
            $table->boolean('refunded');
            $table->longText('stripe_response');

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
        Schema::dropIfExists('purchases');
    }
}
