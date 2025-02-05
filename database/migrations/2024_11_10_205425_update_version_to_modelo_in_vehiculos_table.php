<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            // Eliminar el campo 'version'
            $table->dropColumn('version');

            // Agregar el campo 'modelo' como reemplazo
            $table->string('modelo', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            // Agregar el campo 'version' de nuevo en caso de rollback
            $table->string('version', 255)->nullable();

            // Eliminar el campo 'modelo'
            $table->dropColumn('modelo');
        });
    }
};

