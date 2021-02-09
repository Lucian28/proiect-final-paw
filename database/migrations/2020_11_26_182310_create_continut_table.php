<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continut', function (Blueprint $table) {
            $table->increments('id')->length(11);
            $table->dateTime('data')->nullable();
            $table->integer('idCategorie')->length(11)->nullable();
            $table->string('titlu')->length(256);
            $table->mediumText('descriere');
            $table->integer('idUtilizator')->length(11)->default(1);
            $table->integer('idRating')->length(11)->nullable();
            $table->tinyInteger('verificat')->length(1)->nullable();
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
        Schema::dropIfExists('continut');
    }
}
