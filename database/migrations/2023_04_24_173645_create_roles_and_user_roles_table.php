<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAndUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('roles')) {
          Schema::create('roles', function (Blueprint $table) {
              $table->id();
              $table->string('key');
              $table->string('name');
              $table->integer('role_status');
              $table->timestamps();
          });
      }

      if (!Schema::hasTable('user_roles')) {
          Schema::create('user_roles', function (Blueprint $table) {
              $table->id();
              $table->integer('user_id');
              $table->integer('role_id');
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
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_roles');
    }
}
