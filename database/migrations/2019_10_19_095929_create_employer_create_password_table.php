<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerCreatePasswordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_create_password', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employer_id');
            $table->string('token', 50);
            $table->integer('time_expired');
            $table->string('status')->default(1); // 1- send mail 2- change password
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
        Schema::dropIfExists('employer_create_password');
    }
}
