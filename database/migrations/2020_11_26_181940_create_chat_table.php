<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id')->length(11);
            $table->dateTime('data')->nullable();
            $table->integer('idUtilizator')->length(11);
            $table->integer('idCategorie')->length(11)->nullable();
            $table->integer('idMesaj')->length(11)->nullable();
            $table->string('tip')->length(45)->nullable();
            $table->mediumText('continut');
            $table->tinyInteger('validat')->length(4)->nullable();
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
        Schema::dropIfExists('chat');
    }
}
