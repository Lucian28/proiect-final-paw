<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->id();
          $table->string('UserName');
          $table->string('Nume');
          $table->string('Prenume');
          $table->string('email')->unique();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('imagine')->default('default.jpg')->nullable();
          $table->string('password');
          $table->integer('idRol')->nullable();
          $table->integer('isActiv')->nullable();
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
