<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablasEncuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nombre');
            $table->boolean('visible');
        });
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_encuesta')->unsigned();
            $table->foreign('id_encuesta')->references('id')->on('encuestas');

            $table->integer('orden')->unsigned();

            $table->string('pregunta');
        });
        Schema::create('opciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_pregunta')->unsigned();
            $table->foreign('id_pregunta')->references('id')->on('preguntas');

            $table->integer('orden')->unsigned();

            $table->string('valor');

            $table->unsignedInteger('votos')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opciones');
        Schema::dropIfExists('preguntas');
        Schema::dropIfExists('encuestas');
    }
}
