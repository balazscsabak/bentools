<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToOfferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_items', function (Blueprint $table) {
            $table->text('data')->nullable();
            $table->boolean('is_variant')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_items', function (Blueprint $table) {
            $table->dropColumn('data');
            $table->dropColumn('is_variant');
        });
    }
}
