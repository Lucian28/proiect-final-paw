<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id')->length(11);
            $table->dateTime('data');
            $table->integer('idUtilizator')->lenght(11);
            $table->string('actiune')->lenght(45);
            $table->integer('idContinut')->lenght(11);
            $table->integer('idMesajChat')->lenght(11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
