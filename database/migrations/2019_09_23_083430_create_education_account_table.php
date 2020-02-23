<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->string('school')->nullable()->comment('Trường học trước đây');
            $table->text('filed_study')->nullable()->comment('Ngành học trước đây, map theo filed_work trong DB có sẵn');
            $table->integer('degree')->nullable()->comment('Bằng cấp, map theo helper');
            $table->text('description')->nullable()->comment('Mô tả quá trình học');
            $table->date('start_time')->comment('Thời gian bắt đầu học trước đây')->nullable();
            $table->date('end_time')->comment('Thời gian kết thúc học trước đây')->nullable();
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
        Schema::dropIfExists('account_education');
    }
}
