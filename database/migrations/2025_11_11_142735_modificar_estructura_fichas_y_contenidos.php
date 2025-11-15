<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarEstructuraFichasYContenidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('id_articulo')->nullable();
            $table->string('tipo_articulo')->nullable();

            $table->string('ficha_titulo_es')->nullable();
            $table->text('ficha_bajada_es')->nullable();
            $table->text('ficha_texto_es')->nullable();

			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
        });

        Schema::create('contenidos_fichas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('visible')->default(true);
            $table->bigInteger('orden')->unsigned();

            $table->unsignedBigInteger('id_ficha')->nullable();
            $table->foreign('id_ficha')->references('id')->on('fichas')->cascadeOnDelete();

            $table->string('tipo');

            $table->string('nombre');

            $table->string('imagen')->nullable();
            $table->string('tn')->nullable();
            $table->string('video')->nullable();
        });

        // IMPORTANTE. Si se quiere implementar esta migración en forks previos de este sitio con novedades, páginas o servicios ya creados, deberá 
        // armarse y ejecutar un seeder aquí para migrar dichos modelos a la nueva estructura. Sino, se perderá contenido en el sitio web.

        Schema::table('novedades', function (Blueprint $table) {

            $table->dropColumn('ficha_titulo_es');
            $table->dropColumn('ficha_bajada_es');
            $table->dropColumn('ficha_texto_es');

            $table->dropColumn('ficha_titulo_en');
            $table->dropColumn('ficha_bajada_en');
            $table->dropColumn('ficha_texto_en');
        });

        Schema::table('servicios', function (Blueprint $table) {

            $table->dropColumn('ficha_titulo_es');
            $table->dropColumn('ficha_bajada_es');
            $table->dropColumn('ficha_texto_es');

            $table->dropColumn('ficha_titulo_en');
            $table->dropColumn('ficha_bajada_en');
            $table->dropColumn('ficha_texto_en');
        });

        Schema::table('paginas', function (Blueprint $table) {

            $table->dropColumn('ficha_titulo_es');
            $table->dropColumn('ficha_bajada_es');
            $table->dropColumn('ficha_texto_es');

            $table->dropColumn('ficha_titulo_en');
            $table->dropColumn('ficha_bajada_en');
            $table->dropColumn('ficha_texto_en');
        });

        Schema::dropIfExists('contenidos_paginas');
        Schema::dropIfExists('contenidos_novedades');
        Schema::dropIfExists('contenidos_servicios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paginas', function (Blueprint $table) {

            $table->string('ficha_titulo_es')->nullable();
            $table->text('ficha_bajada_es')->nullable();
            $table->text('ficha_texto_es')->nullable();

			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
        });

        Schema::table('novedades', function (Blueprint $table) {

            $table->string('ficha_titulo_es')->nullable();
            $table->text('ficha_bajada_es')->nullable();
            $table->text('ficha_texto_es')->nullable();

			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
        });

        Schema::table('servicios', function (Blueprint $table) {

            $table->string('ficha_titulo_es')->nullable();
            $table->text('ficha_bajada_es')->nullable();
            $table->text('ficha_texto_es')->nullable();

			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
        });

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

        Schema::create('contenidos_novedades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('visible')->default(true);
            $table->bigInteger('orden')->unsigned();

            $table->unsignedBigInteger('id_novedad');
            $table->foreign('id_novedad')->references('id')->on('novedades');

            $table->string('tipo');

            $table->string('nombre');

            $table->string('imagen')->nullable();
            $table->string('tn')->nullable();
            $table->string('video')->nullable();
        });

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

        Schema::dropIfExists('contenidos_fichas');
        Schema::dropIfExists('fichas');
    }
}
