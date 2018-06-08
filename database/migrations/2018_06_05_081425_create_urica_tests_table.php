<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUricaTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urica_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('urica_highest',10)->nullable();
            $table->smallInteger('pr_score')->default(0);  
            $table->smallInteger('con_score')->default(0);  
            $table->smallInteger('ac_score')->default(0);  
            $table->smallInteger('ma_score')->default(0);  
            $table->unsignedTinyInteger('urica1')->default(0);
            $table->unsignedTinyInteger('urica2')->default(0);
            $table->unsignedTinyInteger('urica3')->default(0);
            $table->unsignedTinyInteger('urica4')->default(0);
            $table->unsignedTinyInteger('urica5')->default(0);
            $table->unsignedTinyInteger('urica6')->default(0);
            $table->unsignedTinyInteger('urica7')->default(0);
            $table->unsignedTinyInteger('urica8')->default(0);
            $table->unsignedTinyInteger('urica9')->default(0);
            $table->unsignedTinyInteger('urica10')->default(0);
            $table->unsignedTinyInteger('urica11')->default(0);
            $table->unsignedTinyInteger('urica12')->default(0);
            $table->unsignedTinyInteger('urica13')->default(0);
            $table->unsignedTinyInteger('urica14')->default(0);
            $table->unsignedTinyInteger('urica15')->default(0);
            $table->unsignedTinyInteger('urica16')->default(0);
            $table->unsignedTinyInteger('urica17')->default(0);
            $table->unsignedTinyInteger('urica18')->default(0);
            $table->unsignedTinyInteger('urica19')->default(0);
            $table->unsignedTinyInteger('urica20')->default(0);
            $table->unsignedTinyInteger('urica21')->default(0);
            $table->unsignedTinyInteger('urica22')->default(0);
            $table->unsignedTinyInteger('urica23')->default(0);
            $table->unsignedTinyInteger('urica24')->default(0);
            $table->unsignedTinyInteger('urica25')->default(0);
            $table->unsignedTinyInteger('urica26')->default(0);
            $table->unsignedTinyInteger('urica27')->default(0);
            $table->unsignedTinyInteger('urica28')->default(0);
            $table->unsignedTinyInteger('urica29')->default(0);
            $table->unsignedTinyInteger('urica30')->default(0);
            $table->unsignedTinyInteger('urica31')->default(0);
            $table->unsignedTinyInteger('urica32')->default(0);  
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
        Schema::dropIfExists('urica_tests');
    }
}
