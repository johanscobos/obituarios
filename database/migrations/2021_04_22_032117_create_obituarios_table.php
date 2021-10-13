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
            $table->string('mensaje');
            $table->string('ciudadid');
            $table->integer('sedeid');
            $table->integer('salaid');
            $table->string('iglesiaid');
            $table->string('horamisa');
            $table->integer('cementerioid');
            $table->string('horadestinofinal');
            $table->date('fechaexequias');
            $table->char('virtual');
            $table->date('iniciopublicacion');
            $table->date('finpublicacion');
            $table->softDeletes();
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
