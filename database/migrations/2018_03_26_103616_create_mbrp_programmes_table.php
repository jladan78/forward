<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbrpProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbrp_programmes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->unique();
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('brs_q')->default(0);
            $table->boolean('urica_q')->default(0);
            $table->boolean('datc_q')->default(0);
            $table->boolean('spsi_q')->default(0);
            $table->boolean('mh_q')->default(0);
            $table->boolean('pf_q')->default(0);  

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
        Schema::dropIfExists('mbrp_programmes');
    }
}
