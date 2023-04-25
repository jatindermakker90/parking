<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnInBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->longText('special_notes')->after('booking_status')->nullable(true)->change();
            $table->float('admin_charge')->after('price')->nullable(true)->change();
            $table->integer('total_days')->after('discount_code')->nullable(true)->change();
             $table->float('extanded_price')->after('admin_charge')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
