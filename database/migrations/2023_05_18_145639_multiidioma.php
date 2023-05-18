<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Multiidioma extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('slides', function (Blueprint $table) {
			$table->renameColumn('titulo', 'titulo_es');
			$table->string('titulo_en')->nullable();
		});

		Schema::table('servicios', function (Blueprint $table) {
			$table->renameColumn('titulo', 'titulo_es');
			$table->renameColumn('texto', 'texto_es');
			$table->renameColumn('ficha_titulo', 'ficha_titulo_es');
			$table->renameColumn('ficha_bajada', 'ficha_bajada_es');
			$table->renameColumn('ficha_texto', 'ficha_texto_es');

			$table->string('titulo_en')->nullable();
			$table->text('texto_en')->nullable();
			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
		});

		Schema::table('novedades', function (Blueprint $table) {
			$table->renameColumn('titulo', 'titulo_es');
			$table->renameColumn('ficha_titulo', 'ficha_titulo_es');
			$table->renameColumn('ficha_bajada', 'ficha_bajada_es');
			$table->renameColumn('ficha_texto', 'ficha_texto_es');

			$table->string('titulo_en')->nullable();
			$table->string('ficha_titulo_en')->nullable();
			$table->text('ficha_bajada_en')->nullable();
			$table->text('ficha_texto_en')->nullable();
		});

		Schema::table('preguntas', function (Blueprint $table) {
			$table->renameColumn('pregunta', 'pregunta_es');
			$table->string('pregunta_en')->nullable();
		});

		Schema::table('opciones', function (Blueprint $table) {
			$table->renameColumn('valor', 'valor_es');
			$table->string('valor_en')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
