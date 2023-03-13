<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteScriptSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_script_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('header_script')->nullable();
            $table->text('footer_script')->nullable();
            $table->text('body_script')->nullable();
            $table->text('booking_script')->nullable();
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
        Schema::dropIfExists('site_script_settings');
    }
}
