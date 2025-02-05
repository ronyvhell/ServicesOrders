<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inspeccions', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('orden_id'); 
            $table->text('fallas_detectadas'); 
            $table->text('objetos_valor'); 
            $table->set('documentos_vehiculo', ['Tarjeta de Propiedad', 'SOAT', 'Tecnomecánica']); 

            // Agregar las relaciones
            $table->foreign('orden_id')->references('id')->on('ordenes_servicio')->onDelete('cascade'); // Relación con ordenes_servicio
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeccions');
    }
};
