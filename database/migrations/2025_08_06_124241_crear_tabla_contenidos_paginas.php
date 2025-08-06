<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaContenidosPaginas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidos_paginas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('visible')->default(true);
            $table->bigInteger('orden')->unsigned();

            $table->unsignedBigInteger('id_pagina');
            $table->foreign('id_pagina')->references('id')->on('paginas');

            $table->string('tipo');

            $table->string('nombre');

            $table->string('imagen')->nullable();
            $table->string('tn')->nullable();
            $table->string('video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenidos_paginas');
    }
}
