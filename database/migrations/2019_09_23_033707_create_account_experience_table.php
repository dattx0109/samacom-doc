<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_experience', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->date('start_time')->comment('Thời gian bắt đầu làm việc trước đây');
            $table->date('end_time')->comment('Thời gian kết thúc làm việc trước đây')->nullable();
            $table->integer('position')->nullable()->comment('chức vụ, vị trí làm việc trước đây, map với helper function getRank()');
            $table->text('company')->nullable()->comment('công ty làm trước đây');
            $table->integer('field_work')->nullable()->comment('Nghề nghiệp trước đây làm, có bảng field_work');
            $table->text('description')->nullable()->comment('Mô tả về công việc làm trước đây');
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
        Schema::dropIfExists('account_experience');
    }
}
