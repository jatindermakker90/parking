<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_terminals', function (Blueprint $table) {
            $table->id();
            $table->string('terminal_name')->nullable();
            $table->unsignedBigInteger('airport_id')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->tinyInteger('terminal_status')->default(0);
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
        Schema::dropIfExists('airport_terminals');
    }
}
