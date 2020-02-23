<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('crawler_job_id')->nullable();
            $table->integer('company_id');
            $table->string('title');
            $table->date('job_publish')->nullable();
            $table->date('job_expire')->nullable();
            $table->decimal('income_min',25)->nullable();
            $table->decimal('income_max', 25)->nullable();
            $table->decimal('base_salary_min', 25)->nullable();
            $table->decimal('base_salary_max', 25)->nullable();
            $table->integer('job_description_id')->nullable();
            $table->integer('employee_description_id')->nullable();
            $table->string('workplace_full_text')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('gender')->nullable()->comment('1 male, 2 female, 3 other');
            $table->integer('level_id')->nullable();
            $table->integer('job_type')->nullable()->comment('1:fulltime,2:parttime;3:hop dong:4:mua vu');
            $table->integer('field_work_id')->nullable();
            $table->tinyInteger('type')->comment('1 job tu dang, 2 là copy về');
            $table->integer('count_apply')->nullable();
            $table->integer('alowance_id')->nullable();
            $table->integer('employer_id')->nullable();
            $table->integer('is_show')->default(1)->comment('1:show;2:hidden');
            $table->integer('is_public')->nullable()->comment('1:public');
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
        Schema::dropIfExists('jobs');
    }
}
