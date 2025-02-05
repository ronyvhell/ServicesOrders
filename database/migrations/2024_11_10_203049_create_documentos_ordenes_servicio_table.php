<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosOrdenesServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_ordenes_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_servicio_id')->constrained('ordenes_servicios')->onDelete('cascade'); // Relación con la orden de servicio
            $table->string('tipo_documento'); // Almacena el tipo de documento ('orden_servicio' o 'orden_salida')
            $table->string('documento_path'); // Ruta del archivo del documento
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
        Schema::dropIfExists('documentos_ordenes_servicio');
    }
}
