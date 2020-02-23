<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountVerifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_verify', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->dateTime('expried_at');
            $table->integer('count_verify');
            $table->char('code',20);
            $table->integer('type')->comment('1:active account,2:forgot password,...');
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
        Schema::dropIfExists('account_verify');
    }
}
