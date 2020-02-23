<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageAdminAddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_admin_add', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('count_view')->nullable();
            $table->integer('count_day_view')->nullable();
            $table->integer('count_employment_post')->nullable();
            $table->integer('count_day_employment_post')->nullable();
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
        Schema::dropIfExists('package_admin_add');
    }
}
