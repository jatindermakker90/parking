<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('airport_id')->nullable(false);
            $table->dateTime('dep_date_time')->nullable(false);
            $table->dateTime('return_date_time')->nullable(false);
            $table->string('discount_code');
            $table->string('title');
            $table->string('first_name')->nullable(false);
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile');
            $table->boolean('cancellation_cover')->default(0);
            $table->boolean('sms_confirmation')->default(0);
            $table->string('no_of_people');
            $table->string('drop_off_terminal');
            $table->string('return_terminal');
            $table->tinyInteger('booking_status')->default(1);
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
        Schema::dropIfExists('bookings');
    }
}
