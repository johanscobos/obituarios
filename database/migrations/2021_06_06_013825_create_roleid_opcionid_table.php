<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleidOpcionidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roleid_opcionid', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rolid');
            $table->unsignedBigInteger('opcionid');
            $table->foreign('rolid')->references('id')->on('roles');
            $table->foreign('opcionid')->references('id')->on('opciones');
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
        Schema::dropIfExists('roleid_opcionid');
    }
}
