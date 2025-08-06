<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPaginas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paginas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->boolean('visible')->default(true);
            $table->string('thumbnail')->nullable();
            $table->string('link')->nullable();

            $table->string('titulo_es');
            $table->string('slug')->unique();
            $table->string('ficha_titulo_es')->nullable();
            $table->text('ficha_bajada_es')->nullable();
            $table->text('ficha_texto_es')->nullable();

			$table->string('titulo_en')->nullable();
			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paginas');
    }
}
