<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->tinyInteger('company_description_id');
            $table->text('address')->nullable();
            $table->integer('company_size')->nullable()->comment('1: 1-10|| 2: 10-50 || 3: 50-100 || 4: 100-200 ||
            5: 200-500 || 6: 500-1000 || 7: trên 1000');
            $table->string('short_name')->nullable()->comment('tên rút gọn của công ty');
            $table->integer('sale_size')->nullable()->comment('Quy mô đội sale của công ty');
            $table->string('workplace')->nullable();
            $table->string('district')->nullable();
            $table->integer('file_id')->nullable();
            $table->string('email')->nullable();
            $table->string('hotline')->nullable();
            $table->string('website')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('companies');
    }
}
