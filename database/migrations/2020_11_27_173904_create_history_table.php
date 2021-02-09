<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('z_id')->lenght(11);
            $table->integer('id')->lenght(11);
            $table->dateTime('data');
            $table->integer('idCategorie')->lenght(11);
            $table->string('titlu')->lenght(125);
            $table->mediumText('descriere');
            $table->integer('idUtilizatorModificare')->lenght(11);
            $table->integer('idRating')->lenght(11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
}
