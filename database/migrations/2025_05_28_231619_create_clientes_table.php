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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 80);
            $table->string('telefono', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->string('codigo_postal', 10)->nullable();
            $table->string('rfc', 20)->nullable();
            $table->string('razon_social', 255)->nullable();
            $table->string('direccion_fiscal', 255)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('clientes');
    }
};
