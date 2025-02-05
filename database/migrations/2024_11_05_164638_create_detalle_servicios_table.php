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
        Schema::create('detalle_servicios', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('orden_id')->constrained('ordenes_servicio'); // Relación con ordenes_servicio
            $table->text('fallas_reportadas'); 
            $table->set('procedimientos_autorizados', ['Diagnóstico', 'Mantenimiento', 'Reparación']); 
            $table->set('verificacion_fluidos', ['Aceite', 'Refrigerante', 'Líquido de Freno']); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_servicios');
    }
};
