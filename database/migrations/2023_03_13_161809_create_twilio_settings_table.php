<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwilioSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twilio_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('twilio_acc_id')->nullable();
            $table->string('twilio_auth_token')->nullable();
            $table->string('twilio_form_number')->nullable();
            $table->enum('twilio_box',[0,1])->default(0)->nullable();
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
        Schema::dropIfExists('twilio_settings');
    }
}
