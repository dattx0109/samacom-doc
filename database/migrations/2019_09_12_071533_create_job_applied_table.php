<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobAppliedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applied', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('job_id');
            $table->tinyInteger('account_id')->comment('Id cua tai khoan ung vien');
            $table->tinyInteger('referral_user_id')->nullable()->comment('Id cua nguoi gioi thieu job');
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
        Schema::dropIfExists('job_applied');
    }
}
