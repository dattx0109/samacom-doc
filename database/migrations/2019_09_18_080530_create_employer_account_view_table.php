<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerAccountViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_account_view', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employer_id');
            $table->integer('account_id');
            $table->tinyInteger('status_view')->comment('0 la chua xem,1 la da xem')->nullable();
            $table->tinyInteger('status_like')->comment('0 la chua like,1 la da like')->nullable();
            $table->tinyInteger('status_open')->comment('0 la chua mo,1 la da mo')->nullable();
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
        Schema::dropIfExists('employer_account_view');
    }
}
