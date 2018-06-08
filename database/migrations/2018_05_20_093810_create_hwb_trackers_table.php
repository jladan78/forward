<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHwbTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwb_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->text('description')->nullable();
            $table->dateTime('date_track');
            $table->unsignedTinyInteger('sn_value')->default(0);
            $table->unsignedTinyInteger('pcls_value')->default(0);
            $table->unsignedTinyInteger('emp_value')->default(0);
            $table->unsignedTinyInteger('nps_value')->default(0);
            $table->unsignedTinyInteger('ips_value')->default(0);
            $table->unsignedTinyInteger('smk_value')->default(0);
            $table->unsignedTinyInteger('sh_value')->default(0);
            $table->unsignedTinyInteger('ph_value')->default(0);
            $table->unsignedTinyInteger('mh_value')->default(0);
            $table->unsignedTinyInteger('dau_value')->default(0);
            $table->text('sn_notes')->nullable();
            $table->text('pcls_notes')->nullable();
            $table->text('emp_notes')->nullable();
            $table->text('nps_notes')->nullable();
            $table->text('ips_notes')->nullable();
            $table->text('smk_notes')->nullable();
            $table->text('sh_notes')->nullable();
            $table->text('ph_notes')->nullable();
            $table->text('mh_notes')->nullable();
            $table->text('dau_notes')->nullable();
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hwb_trackers');
    }
}
