<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbrpQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbrp_questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->tinyInteger('client_age')->unsigned();
            $table->string('stage',15);
            $table->integer('mbrp_programme_id')->unsigned();
            $table->dateTime('date_engaged')->nullable();
            $table->dateTime('date_completed')->nullable();
            $table->boolean('is_completed')->nullable();
            $table->string('end_reason',5)->nullable();
            $table->boolean('brs_q')->default(0);
            $table->integer('brs_test_id')->unsigned()->nullable();
            $table->boolean('urica_q')->default(0);
            $table->integer('urica_test_id')->unsigned()->nullable();
            $table->boolean('datc_q')->default(0);
            $table->integer('datc_test_id')->unsigned()->nullable();
            $table->boolean('spsi_q')->default(0);
            $table->integer('spsi_test_id')->unsigned()->nullable();
            $table->boolean('mh_q')->default(0);
            $table->integer('mh_test_id')->unsigned()->nullable();
            $table->boolean('pf_q')->default(0);     
            $table->unsignedTinyInteger('pf1')->default(0); 
            $table->unsignedTinyInteger('pf2')->default(0); 
            $table->unsignedTinyInteger('pf3')->default(0); 
            $table->unsignedTinyInteger('pf4')->default(0); 
            $table->unsignedTinyInteger('pf5')->default(0); 
            $table->unsignedTinyInteger('pf6')->default(0);
            $table->unsignedTinyInteger('pf7')->default(0); 
            $table->unsignedTinyInteger('pf8')->default(0); 
            $table->unsignedTinyInteger('pf9')->default(0); 
            $table->unsignedTinyInteger('pf10')->default(0); 
            $table->unsignedTinyInteger('pf11')->default(0);    
            $table->text('pf_comments')->nullable();
            $table->timestamps();

            $table->foreign('mbrp_programme_id')->references('id')->on('mbrp_programmes');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('brs_test_id')->references('id')->on('brs_tests')->onDelete('cascade');
            $table->foreign('urica_test_id')->references('id')->on('urica_tests')->onDelete('cascade');
            $table->foreign('datc_test_id')->references('id')->on('datc_tests')->onDelete('cascade');
            $table->foreign('spsi_test_id')->references('id')->on('spsi_tests')->onDelete('cascade');
            $table->foreign('mh_test_id')->references('id')->on('mh_tests')->onDelete('cascade');

      /*       $table->integer('idproveedor')->unsigned();
            $table->foreign('idproveedor')->references('id')->on('proveedores');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users');
            $table->string('tipo_comprobante', 20);
            $table->string('serie_comprobante', 7)->nullable();
            $table->string('num_comprobante', 10);
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto', 4, 2);
            $table->decimal('total', 11, 2);
            $table->string('estado', 20); */

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mbrp_questionnaires');
    }
}
