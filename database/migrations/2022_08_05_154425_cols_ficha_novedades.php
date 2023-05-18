<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ColsFichaNovedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novedades', function (Blueprint $table) {
            $table->string('ficha_titulo')->nullable();
            $table->text('ficha_bajada')->nullable();
            $table->text('ficha_texto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novedades', function (Blueprint $table) {
            $table->dropColumn('ficha_titulo');
            $table->dropColumn('ficha_bajada');
            $table->dropColumn('ficha_texto');
        });
    }
}
