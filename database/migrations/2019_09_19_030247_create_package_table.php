<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255)->nullable();
            $table->integer('group_package');
            $table->text('description')->nullable();
            $table->text('sort_description')->nullable();
            $table->decimal('price',20,2)->nullable();
            $table->decimal('price_sale',20,2)->nullable();
            $table->integer('is_show')->nullable();
            $table->string('image')->nullable();
            $table->integer('count_view')->nullable();
            $table->integer('count_day_view')->nullable();
            $table->integer('count_employment_post')->nullable();
            $table->integer('count_day_employment_post')->nullable();
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
        Schema::dropIfExists('package');
    }
}
