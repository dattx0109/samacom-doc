<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryEmployerPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_package_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id');
            $table->integer('employer_id');
            $table->integer('count')->comment('số luong goi');
            $table->integer('package_type')->comment('1: gói package có sẵn || 2: Gói package thêm mới');
            $table->integer('admin_id')->comment('người thêm package')->nullable();
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
        Schema::dropIfExists('employer_package_history');
    }
}
