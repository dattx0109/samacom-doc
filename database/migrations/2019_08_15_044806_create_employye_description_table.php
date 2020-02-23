<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployyeDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_description', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('degree')->nullable()->comment('1:trung cap;2:cao dang:3:dai hoc;4:tren dai hoc');
            $table->integer('experience')->nullable()->comment('1:no-exp,2:6 month,3:1 year,4:2 year:5:3 year:6:more 3 year');
            $table->string('appearance')->nullable();
            $table->string('voice')->nullable();
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
        Schema::dropIfExists('employee_description');
    }
}
