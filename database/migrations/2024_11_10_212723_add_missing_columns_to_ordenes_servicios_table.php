<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToOrdenesServiciosTable extends Migration
{
    public function up()
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            if (!Schema::hasColumn('ordenes_servicios', 'fallas_reportadas')) {
                $table->text('fallas_reportadas')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'servicio')) {
                $table->string('servicio')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'precio')) {
                $table->decimal('precio', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'procedimientos_autorizados')) {
                $table->json('procedimientos_autorizados')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'verificacion_fluidos')) {
                $table->json('verificacion_fluidos')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'autorizacion_prueba_ruta')) {
                $table->boolean('autorizacion_prueba_ruta')->default(false);
            }
            if (!Schema::hasColumn('ordenes_servicios', 'fallas_detectadas')) {
                $table->text('fallas_detectadas')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'objetos_valor')) {
                $table->text('objetos_valor')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'documentos_vehiculo')) {
                $table->json('documentos_vehiculo')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'foto_frente')) {
                $table->string('foto_frente')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'foto_atras')) {
                $table->string('foto_atras')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'foto_lateral_izquierdo')) {
                $table->string('foto_lateral_izquierdo')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'foto_lateral_derecho')) {
                $table->string('foto_lateral_derecho')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'orden_servicio')) {
                $table->string('orden_servicio')->nullable();
            }
            if (!Schema::hasColumn('ordenes_servicios', 'orden_salida')) {
                $table->string('orden_salida')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->dropColumn([
                'fallas_reportadas',
                'servicio',
                'precio',
                'procedimientos_autorizados',
                'verificacion_fluidos',
                'autorizacion_prueba_ruta',
                'fallas_detectadas',
                'objetos_valor',
                'documentos_vehiculo',
                'foto_frente',
                'foto_atras',
                'foto_lateral_izquierdo',
                'foto_lateral_derecho',
                'orden_servicio',
                'orden_salida',
            ]);
        });
    }
}
