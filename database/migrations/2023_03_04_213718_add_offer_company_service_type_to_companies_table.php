<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfferCompanyServiceTypeToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('offer_types')->nullable()->after('company_status');
            $table->string('company_types')->nullable()->after('offer_types');
            $table->string('service_types')->nullable()->after('company_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('offer_types');
            $table->dropColumn('company_types');
            $table->dropColumn('service_types');
        });
    }
}
