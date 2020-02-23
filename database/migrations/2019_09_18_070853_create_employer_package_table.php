<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_package_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id');
            $table->integer('employer_id');
            $table->integer('count')->nullable()->comment('số lượng gói');
            $table->integer('status')->nullable()->comment('trang thai yeu cau: 1:moi gui yeu cau;2:khong lien lac duoc;3:khac hang ko mua;4:cho chuyen tien;5:khong chuyen tien;6:kich hoat thanh cong');
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
        Schema::dropIfExists('employer_package_request');
    }
}
