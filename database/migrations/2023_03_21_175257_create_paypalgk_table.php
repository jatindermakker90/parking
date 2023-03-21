<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalgkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('paypal_email')->nullable();
            $table->string('paypal_url')->nullable();
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
        Schema::dropIfExists('paypal');
    }
}
