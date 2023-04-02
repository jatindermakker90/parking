<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable(false);
            $table->dateTime('review_date')->nullable(false);
            $table->dateTime('publish_date')->nullable(false);
            $table->tinyInteger('is_recommend')->default(0);
            $table->string('comments');
            $table->tinyInteger('convenience')->default(1);
            $table->tinyInteger('punctuality')->default(1);
            $table->tinyInteger('customer_service')->default(1);
            $table->tinyInteger('collection_vehicle')->default(1);
            $table->tinyInteger('overall')->default(1);
            //$table->foreign('booking_id')->references('id')->on('bookings');
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
        Schema::dropIfExists('reviews');
    }
}
