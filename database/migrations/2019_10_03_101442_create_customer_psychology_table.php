<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPsychologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_psychology', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_KH')->comment('tên khách hàng duoc khao sat');
            $table->tinyInteger('giong_noi_KH')->nullable()->comment('1: mỏng || 2: Dày');
            $table->tinyInteger('khuon_mat_KH')->nullable()->comment('1: mềm mỏng || 2: góc cạnh');
            $table->tinyInteger('khi_chat_KH')->nullable()->comment('1: dễ gần || 2: Khó gần');
            $table->string('nam_sinh_KH')->nullable()->comment('1: dễ gần || 2: Khó gần');
            $table->text('linh_vuc_hoat_dong_KH')->nullable();
            $table->tinyInteger('gioi_tinh_KH')->nullable()->comment('1:nam || 2:nu');
            $table->text('ten_lien_lac')->nullable()->comment('ten khach hang de lien lac gui thong tin ma KH do khao sat');
            $table->tinyInteger('gioi_tinh')->nullable()->comment('Gioi tinh khach hang khao sat');
            $table->string('nam_sinh')->nullable()->comment('Ngay sinh khach hang khao sat');
            $table->string('sdt')->nullable()->comment('sdt cua khach hang khao sat');
            $table->string('email')->nullable()->comment('email khach hang khao sat');
            $table->string('nganh_dang_lam')->nullable()->comment('nganh nghe cua khach hang khao sat');
            $table->string('vi_tri_sale')->nullable()->comment('vi tri sale cua khach hang khao sat');
            $table->tinyInteger('type')->nullable()->comment('1:Than thai || 2: Nhan khau hoc || 3: Nhan tuong hoc');
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
        Schema::dropIfExists('customer_psychology');
    }
}
