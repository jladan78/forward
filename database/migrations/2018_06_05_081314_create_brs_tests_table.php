<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrsTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brs_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('brs1')->default(0); 
            $table->unsignedTinyInteger('brs2')->default(0); 
            $table->unsignedTinyInteger('brs3')->default(0); 
            $table->unsignedTinyInteger('brs4')->default(0); 
            $table->unsignedTinyInteger('brs5')->default(0); 
            $table->unsignedTinyInteger('brs6')->default(0); 
            $table->smallInteger('brs_score')->default(0); 
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
        Schema::dropIfExists('brs_tests');
    }
}
