<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaContenidosServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidos_servicios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('visible')->default(true);
            $table->bigInteger('orden')->unsigned();

            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_servicio')->references('id')->on('servicios');

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
        Schema::dropIfExists('contenidos_servicios');
    }
}
