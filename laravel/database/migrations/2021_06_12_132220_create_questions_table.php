<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('questions', function (Blueprint $table) {
          $table->increments('id');
          $table->string('text')->comment('本文');
          $table->integer('number')->comment('問題番号');
          $table->rememberToken();
          $table->timestamps();

          $table->index('id');
          $table->index('text');
          $table->index('number');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
