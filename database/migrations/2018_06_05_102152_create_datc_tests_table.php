<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatcTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datc_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('dtc_score')->default(0);  
            $table->unsignedTinyInteger('dtc1')->default(0);
            $table->unsignedTinyInteger('dtc2')->default(0);
            $table->unsignedTinyInteger('dtc3')->default(0);
            $table->unsignedTinyInteger('dtc4')->default(0);
            $table->unsignedTinyInteger('dtc5')->default(0);
            $table->unsignedTinyInteger('dtc6')->default(0);
            $table->unsignedTinyInteger('dtc7')->default(0);
            $table->unsignedTinyInteger('dtc8')->default(0);
            $table->smallInteger('atc_score')->default(0);  
            $table->unsignedTinyInteger('atc1')->default(0);
            $table->unsignedTinyInteger('atc2')->default(0);
            $table->unsignedTinyInteger('atc3')->default(0);
            $table->unsignedTinyInteger('atc4')->default(0);
            $table->unsignedTinyInteger('atc5')->default(0);
            $table->unsignedTinyInteger('atc6')->default(0);
            $table->unsignedTinyInteger('atc7')->default(0);
            $table->unsignedTinyInteger('atc8')->default(0);
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
        Schema::dropIfExists('datc_tests');
    }
}
