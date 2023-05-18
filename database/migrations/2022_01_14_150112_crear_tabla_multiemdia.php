<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaMultiemdia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('visible')->default(true);
            $table->bigInteger('orden')->unsigned();
            $table->string('tipo');

            $table->string('nombre');

            $table->string('imagen')->nullable();
            $table->string('tn')->nullable();
            $table->string('video')->nullable();
            $table->string('epigrafe')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia');
    }
}
