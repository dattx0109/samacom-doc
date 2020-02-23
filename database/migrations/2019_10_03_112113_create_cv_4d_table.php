<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCv4dTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_4d', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('tên khách hàng duoc khao sat');
            $table->tinyInteger('gioi_tinh')->nullable()->comment('1: nam || 2: nu');
            $table->tinyInteger('giong_noi')->nullable()->comment('1: mỏng || 2: Dày');
            $table->tinyInteger('khuon_mat')->nullable()->comment('1: mềm mỏng || 2: góc cạnh');
            $table->tinyInteger('khi_chat')->nullable()->comment('1: dễ gần || 2: Khó gần');
            $table->tinyInteger('type')->nullable()->comment('1:Than thai || 2: Nhan khau hoc || 3: Nhan tuong hoc');
            $table->string('so_dien_thoai')->nullable();
            $table->string('email')->nullable();
            $table->string('nam_sinh')->nullable();
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
        Schema::dropIfExists('cv_4d');
    }
}
