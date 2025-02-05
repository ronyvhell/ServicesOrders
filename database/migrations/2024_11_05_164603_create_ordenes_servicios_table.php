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
        Schema::create('ordenes_servicios', function (Blueprint $table) {
            $table->id(); // id BIGINT [pk, increment]
            $table->foreignId('cliente_id')->constrained('clientes'); // Relación con clientes
            $table->foreignId('vehiculo_id')->constrained('vehiculos'); // Relación con vehiculos
            $table->enum('tipo_servicio', ['garantía', 'reparación', 'mantenimiento']); 
            $table->timestamp('fecha_creacion')->useCurrent(); 
            $table->text('notas'); 
            $table->enum('estado', ['pendiente', 'nuevo', 'en proceso', 'finalizado', 'cancelado']); 
            $table->foreignId('tecnico_id')->constrained('tecnicos'); // Relación con tecnicos
            $table->string('kilometraje'); 
            $table->string('autorizacion_prueba_ruta'); 
            $table->enum('nivel_combustible', ['Vacío', 'Medio', 'Completo']); 
            $table->decimal('subtotal', 10, 2); 
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_servicios');
    }
};
