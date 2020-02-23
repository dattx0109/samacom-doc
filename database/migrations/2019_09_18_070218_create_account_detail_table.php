<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->mediumText('avatar')->comment('ảnh chân dung')->nullable();
            $table->tinyInteger('gender')->comment('1 là nam 2 là nữ')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->text('full_address')->comment('địa chỉ chi tiết hiện tại đang ở của ứng viên')->nullable();
            $table->text('link_fb')->nullable();
            $table->text('career_goals')->comment('mục tiêu nghề nghiệp')->nullable();
            $table->tinyInteger('marital_status')->comment('tình trạng hôn nhân:1 là độc thân,2 là đã có gia đình, 3 co con')->nullable();
            $table->text('extracurricular_activities')->comment('hoạt động ngoại khóa')->nullable();
            $table->text('strengths_weaknesses')->comment('Điểm mạnh điểm yếu')->nullable();
            $table->integer('height')->comment('chiều cao của ứng viên')->nullable();
//            $table->tinyInteger('character')->comment('tính cách của ứng viên')->nullable();
            $table->tinyInteger('job_search_status')->comment('trạng thái tìm việc:1 là đang tìm việc, 2 là đang cân nhắc,3 là không tìm việc')->nullable();
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
        Schema::dropIfExists('account_detail');
    }
}
