<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('reference',10)->unique(); 
            $table->string('initials',10)->nullable();
            $table->date('dob');
            $table->string('contact',50)->nullable();
            $table->string('contact_phone',50)->nullable(); 
            $table->timestamps();
            $table->foreign('id')->references('id')->on('persons')->onDelete('cascade'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
