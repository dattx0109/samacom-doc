<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountWishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_wish', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('filed_work_wish')->nullable()->comment('linh vuc mong muon lam');
            $table->integer('account_id');
            $table->integer('position_wish')->nullable()->comment('vi tri sales mong muon lam viec xem helper getGroupSales()');
            $table->integer('salary_wish')->nullable()->comment('muc luong mong muon, trong khoang');
            $table->integer('province_id')->nullable()->comment('Tinh, thanh pho mong muon lam');
            $table->integer('district_id')->nullable()->comment('Quan huyen mong muon lam');
            $table->integer('current_priority')->nullable()->comment('Dieu mong muon, xem helper');
            $table->integer('job_type_wish')->nullable()->comment('Loại hình công việc mong muốn| xem helper getJobType() ');
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
        Schema::dropIfExists('account_wish');
    }
}
