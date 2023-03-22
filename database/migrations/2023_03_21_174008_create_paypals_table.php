<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_express', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('live_email')->nullable();
            $table->string('test_email')->nullable();
            $table->string('live_private_key')->nullable();
            $table->string('live_public_key')->nullable();
            $table->string('test_private_key')->nullable();
            $table->string('test_public_key')->nullable();
            $table->string('live_url')->nullable();
            $table->string('test_url')->nullable();
            $table->enum('gateway_activation_status',[0,1])->default(0)->nullable();
            $table->enum('testmode_status',[0,1])->default(0)->nullable();
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
        Schema::dropIfExists('paypal_express');
    }
}
