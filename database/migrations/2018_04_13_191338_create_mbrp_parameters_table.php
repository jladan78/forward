<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbrpParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbrp_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('code',10)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('score')->nullable();
            $table->boolean('active')->default(1);
            $table->string('field',50)->nullable()->default('');
            $table->tinyInteger('order')->unsigned();
            $table->string('param_type',50)->nullable()->default('');
            $table->tinyInteger('bottom_value')->nullable()->default(0);
            $table->tinyInteger('top_value')->nullable()->default(0);  
            $table->boolean('opt_prison')->default(0);
            $table->boolean('opt_community')->default(0);
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
        Schema::dropIfExists('mbrp_parameters');
    }
}
