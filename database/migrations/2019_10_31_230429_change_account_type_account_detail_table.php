<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAccountTypeAccountDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_detail', function (Blueprint $table) {
//            $table->dropColumn('job_type');
//            $table->integer('image_type')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_detail', function (Blueprint $table) {
//            $table->dropColumn('image_type');


        });
    }
}
