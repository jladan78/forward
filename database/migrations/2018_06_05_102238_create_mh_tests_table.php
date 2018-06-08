<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMhTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mh_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('dep_score')->default(0);  
            $table->unsignedTinyInteger('dep1')->default(0);
            $table->unsignedTinyInteger('dep2')->default(0);
            $table->unsignedTinyInteger('dep3')->default(0);
            $table->unsignedTinyInteger('dep4')->default(0);
            $table->unsignedTinyInteger('dep5')->default(0);
            $table->unsignedTinyInteger('dep6')->default(0);
            $table->unsignedTinyInteger('dep7')->default(0);
            $table->unsignedTinyInteger('dep8')->default(0);
            $table->unsignedTinyInteger('dep9')->default(0);
            $table->smallInteger('anx_score')->default(0);  
            $table->unsignedTinyInteger('anx1')->default(0);
            $table->unsignedTinyInteger('anx2')->default(0);
            $table->unsignedTinyInteger('anx3')->default(0);
            $table->unsignedTinyInteger('anx4')->default(0);
            $table->unsignedTinyInteger('anx5')->default(0);
            $table->unsignedTinyInteger('anx6')->default(0);
            $table->unsignedTinyInteger('anx7')->default(0);
            $table->unsignedTinyInteger('anx8')->default(0);
            $table->unsignedTinyInteger('anx9')->default(0);
            $table->smallInteger('tra_score')->default(0);  
            $table->unsignedTinyInteger('tra1')->default(0);
            $table->unsignedTinyInteger('tra2')->default(0);
            $table->unsignedTinyInteger('tra3')->default(0);
            $table->unsignedTinyInteger('tra4')->default(0);
            $table->smallInteger('sw_score')->default(0); 
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
        Schema::dropIfExists('mh_tests');
    }
}
