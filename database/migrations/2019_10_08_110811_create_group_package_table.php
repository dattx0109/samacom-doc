<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->text('image');
            $table->decimal('price_start',20,2);
            $table->decimal('price_end',20,2);
            $table->text('description');
            $table->integer('is_show');
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
        Schema::dropIfExists('group_package');
    }
}
