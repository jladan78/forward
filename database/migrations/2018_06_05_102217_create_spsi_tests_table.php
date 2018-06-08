<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpsiTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spsi_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('ppo_score')->default(0);
            $table->smallInteger('npo_score')->default(0); 
            $table->smallInteger('rps_score')->default(0); 
            $table->smallInteger('ics_score')->default(0); 
            $table->smallInteger('as_score')->default(0);
            $table->smallInteger('sps_score')->default(0);    
            $table->unsignedTinyInteger('spsi1')->default(0);
            $table->unsignedTinyInteger('spsi2')->default(0);
            $table->unsignedTinyInteger('spsi3')->default(0);
            $table->unsignedTinyInteger('spsi4')->default(0);
            $table->unsignedTinyInteger('spsi5')->default(0);
            $table->unsignedTinyInteger('spsi6')->default(0);
            $table->unsignedTinyInteger('spsi7')->default(0);
            $table->unsignedTinyInteger('spsi8')->default(0);
            $table->unsignedTinyInteger('spsi9')->default(0);
            $table->unsignedTinyInteger('spsi10')->default(0);
            $table->unsignedTinyInteger('spsi11')->default(0);
            $table->unsignedTinyInteger('spsi12')->default(0);
            $table->unsignedTinyInteger('spsi13')->default(0);
            $table->unsignedTinyInteger('spsi14')->default(0);
            $table->unsignedTinyInteger('spsi15')->default(0);
            $table->unsignedTinyInteger('spsi16')->default(0);
            $table->unsignedTinyInteger('spsi17')->default(0);
            $table->unsignedTinyInteger('spsi18')->default(0);
            $table->unsignedTinyInteger('spsi19')->default(0);
            $table->unsignedTinyInteger('spsi20')->default(0);
            $table->unsignedTinyInteger('spsi21')->default(0);
            $table->unsignedTinyInteger('spsi22')->default(0);
            $table->unsignedTinyInteger('spsi23')->default(0);
            $table->unsignedTinyInteger('spsi24')->default(0);
            $table->unsignedTinyInteger('spsi25')->default(0);
        
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
        Schema::dropIfExists('spsi_tests');
    }
}
