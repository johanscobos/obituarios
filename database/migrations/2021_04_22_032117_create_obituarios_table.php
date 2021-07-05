<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObituariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obituarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('ciudad');
            $table->integer('sedeid');
            $table->integer('salaid');
            $table->string('misa');
            $table->date('fechaexequias');
            $table->integer('cementerioid');
            $table->string('virtual');
            $table->string('url');
            $table->date('iniciopublicacion');
            $table->date('finpublicacion');
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
        Schema::dropIfExists('obituarios');
    }
}
