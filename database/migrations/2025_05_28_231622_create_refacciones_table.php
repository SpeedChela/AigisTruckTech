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
        Schema::create('refacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proveedor')->constrained('proveedores');
            $table->string('nombre', 80);
            $table->string('marca', 80)->nullable();
            $table->string('categoria', 80)->nullable();
            $table->string('tipo_refaccion', 80)->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->integer('cant_existente')->default(0);
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
        Schema::dropIfExists('refacciones');
    }
};
