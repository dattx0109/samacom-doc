<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralUserCreatePasswordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_user_create_password', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('referral_user_id');
            $table->string('token');
            $table->integer('time_expired');
            $table->tinyInteger('status')->comment('1: new user 2: active')->default(1);
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
        Schema::dropIfExists('referral_user_create_password');
    }
}
