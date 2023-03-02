<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_title')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_url')->nullable();
            $table->string('company_sku_id')->nullable();
            $table->string('company_sku_tag')->nullable();
            $table->string('company_sku_sending_tag')->nullable();
            $table->integer('company_sequence')->nullable();
            $table->integer('min_sms')->nullable();
            $table->integer('daily_bookings')->nullable();
            $table->integer('monthly_bookings')->nullable();
            $table->double('company_commission',8)->nullable();
            $table->double('extra_amount',8)->nullable();
            $table->double('levy_charge',8)->nullable();
            $table->text('short_notes')->nullable();
            $table->text('parking_procedure_email')->nullable();
            $table->text('drop_off_procedure')->nullable();
            $table->text('return_procedure')->nullable();
            $table->text('company_overview')->nullable();
            $table->text('short_description')->nullable();
            $table->unsignedBigInteger('airport_id')->nullable();
            $table->unsignedBigInteger('terminal_id')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('logo_id')->nullable();
            $table->tinyInteger('protection_status')->nullable();
            $table->tinyInteger('add_extra_status')->nullable();
            $table->tinyInteger('levy_charge_status')->nullable();
            $table->tinyInteger('send_csv')->nullable();
            $table->tinyInteger('company_status')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
