<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('controller')->nullable();
            $table->string('action')->nullable();
            $table->string('exception_message')->nullable();
            $table->string('message');
            $table->string('reference_d')->nullable();
            $table->string('reference_v')->nullable();
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
        Schema::dropIfExists('errors');
    }
}
