<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('county')->default('');
            $table->string('billing_postcode')->default('');
            $table->string('billing_county')->default('');
            $table->string('billing_city')->default('');
            $table->string('billing_street')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('county');
            $table->dropColumn('billing_postcode');
            $table->dropColumn('billing_county');
            $table->dropColumn('billing_city');
            $table->dropColumn('billing_street');
        });
    }
}
