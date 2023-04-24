<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
          $table->string('ref_id')->after('id')->nullable(true);
          $table->dateTime('updated_dep_date_time')->after('dep_date_time')->nullable(true);
          $table->dateTime('updated_return_date_time')->after('return_date_time')->nullable(true);
          $table->longText('special_notes')->after('booking_status');
          $table->float('admin_charge')->after('price');
          $table->float('total_days')->after('discount_code');
          $table->float('extanded_price')->after('admin_charge');
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
           $table->dropColumn('ref_id');
           $table->dropColumn('updated_dep_date_time');
           $table->dropColumn('updated_return_date_time');
           $table->dropColumn('special_notes');
           $table->dropColumn('admin_charge');
           $table->dropColumn('total_days');
           $table->dropColumn('extanded_price');
        });
    }
}
