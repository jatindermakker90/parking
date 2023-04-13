<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableThatsNamePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->string('booking_ref_id');
            $table->float('base_price')->default(0.00);
            $table->float('booking_charge')->default(0.00);
            $table->float('sms_charge')->default(0.00);
            $table->float('cancellation_charge')->default(0.00);
            $table->float('discount_amount')->default(0.00);
            $table->float('total_price')->default(0.00);
            $table->tinyInteger('status')->default(2)->length(4)->comment('1 For Complete, 2 For In-Complete, 3 For In-Process');
            $table->string('transaction_id')->nullable(true);
            $table->string('payment_method')->nullable(true);
            $table->float('paid_amount')->default(0.00);
            $table->dateTime('payment_date');
            $table->text('payment_notes')->nullable(true);
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
        Schema::dropIfExists('payments');
    }
}
