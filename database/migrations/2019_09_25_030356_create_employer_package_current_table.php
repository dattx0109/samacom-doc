<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerPackageCurrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_package_current', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employer_id');
            $table->date('view_expired_at');
            $table->date('post_expired_at');
            $table->integer('count_view_contact_profile');
            $table->integer('count_post');
            $table->integer('count_use_view');
            $table->integer('count_use_post');
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
        Schema::dropIfExists('employer_package_current');
    }
}
