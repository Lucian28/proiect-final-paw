<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogErrorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_error', function (Blueprint $table) {
            $table->increments('id')->lenght(11);
            $table->mediumText('message');
            $table->mediumText('request_parameter');
            $table->mediumText('query');
            $table->string('stacktrace')->lenght(125);
            $table->string('level')->lenght(125);
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
        Schema::dropIfExists('log_error');
    }
}
