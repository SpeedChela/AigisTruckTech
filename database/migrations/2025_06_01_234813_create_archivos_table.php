<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_original');
            $table->string('nombre_sistema');
            $table->string('ruta');
            $table->string('tipo_mime');
            $table->integer('tamanio');
            $table->string('extension');
            $table->morphs('archivable'); // Esto permite relacionar el archivo con cualquier otro modelo
            $table->string('tipo', 50)->default('imagen'); // imagen, pdf, etc.
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('archivos');
    }
};
