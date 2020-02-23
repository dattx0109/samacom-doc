<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerLandingPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_landing_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('ten cua nha tuyen dung');
            $table->string('email')->nullable()->comment('email cua nha tuyen dung');
            $table->string('phone')->nullable()->comment('phone cua nha tuyen dung');
            $table->string('name_company')->nullable()->comment('Ten cong ty can tuyen dung');
            $table->tinyInteger('group_package_id')->nullable()->comment('nhom goi san pham');
            $table->string('package_id')->nullable()->comment('goi san pham');
            $table->tinyInteger('number')->nullable()->comment('so luong mua goi san pham');
            $table->tinyInteger('status')->nullable()->comment('trang thai yeu cau|| 1: moi gui yeu cau || 2: khong lien lac duoc || 3: da lien lac khong mua || 4 dong y mua');
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
        Schema::dropIfExists('employer_landing_page');
    }
}
