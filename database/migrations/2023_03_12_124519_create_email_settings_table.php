<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('smtp2go_api_key')->nullable();
            $table->string('smtp2go_base_url')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->enum('smtp_debug_status',[0,1])->default(0)->nullable();
            $table->enum('smtp_ssl_status',[0,1])->default(0)->nullable();
            $table->string('review_smtp_host')->nullable();
            $table->string('review_smtp_username')->nullable();
            $table->string('review_smtp_passowrd')->nullable();
            $table->integer('review_smtp_port')->nullable();
            $table->enum('review_smtp_debug_status',[0,1])->default(0)->nullable();
            $table->enum('review_smtp_ssl_status',[0,1])->default(0)->nullable();
            $table->string('from_email_confirmation')->nullable();
            $table->string('from_email_amend')->nullable();
            $table->string('from_email_cancel')->nullable();
            $table->string('email_cc')->nullable();
            $table->string('email_bcc')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('noreply_confirmation')->nullable();
            $table->string('noreply_amend')->nullable();
            $table->string('noreply_cancel')->nullable();
            $table->string('default_smtp_gateway')->nullable();
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
        Schema::dropIfExists('email_settings');
    }
}
