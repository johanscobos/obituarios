<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseridRoleidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userid_roleid', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rolid');
            $table->unsignedBigInteger('userid');
            $table->foreign('rolid')->references('id')->on('roles');
            $table->foreign('userid')->references('id')->on('users');
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
        Schema::dropIfExists('userid_roleid');
    }
}
