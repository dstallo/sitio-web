<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_fichas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('visible')->default(true);
            $table->bigInteger('orden')->unsigned();

            $table->unsignedBigInteger('id_ficha')->nullable();
            $table->foreign('id_ficha')->references('id')->on('fichas')->cascadeOnDelete();

            $table->string('nombre');
            $table->string('tipo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('archivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_fichas');
    }
}
