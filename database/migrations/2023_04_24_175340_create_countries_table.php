<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->char('country_iso_code',6)->nullable(true);
                $table->char('currency_iso_code',6)->nullable(true);
                $table->char('language_iso_code',6)->nullable(true);
                $table->string('country')->nullable(true);
                $table->string('currency')->nullable(true);
                $table->string('language')->nullable(true);
                $table->integer('country_code')->nullable(true);
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
