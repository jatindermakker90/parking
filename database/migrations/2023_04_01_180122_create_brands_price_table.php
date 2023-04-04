<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_price', function (Blueprint $table) {
            $table->id();
            $table->text('brand')->nullable(true);
            $table->tinyInteger('status')->default(0)->comment("0=>Inactive, 1=>Active");
            $table->json('days_price')->nullable(true);
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
        Schema::dropIfExists('brands_price');
    }
}
