<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable(false);
            $table->float('base_price')->nullable(false);
            $table->boolean('per_day_increment_status')->default(0)->nullable(false);
            $table->string('per_day_increment_type')->default(0)->nullable(true);
            $table->float('per_day_increment_amount')->default(0)->nullable(true);
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
        Schema::dropIfExists('company_prices');
    }
}
