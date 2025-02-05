<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesServicioProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_servicio_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_servicio_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('orden_servicio_id')->references('id')->on('ordenes_servicios')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
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
        Schema::dropIfExists('ordenes_servicio_producto');
    }
}
