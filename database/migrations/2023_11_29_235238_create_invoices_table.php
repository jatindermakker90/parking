<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->dateTime('e_date')->nullable();
            $table->dateTime('r_date')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('first_name')->nullable();
            $table->double('gross_amount',8)->nullable();
            $table->tinyInteger('inoice_status')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
