<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreatePassEmployerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_pass_employer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employer_id');
            $table->string('token');
            $table->tinyInteger('type')->comment('1:nhà tuyển dụng 2:referral');
            $table->tinyInteger('is_active')->comment('tinh trang su dung token,0: chua sd,1: la da sd');
            $table->dateTime('date_expired')->comment('han su dung token');
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
        Schema::dropIfExists('create_pass_employer');
    }
}
