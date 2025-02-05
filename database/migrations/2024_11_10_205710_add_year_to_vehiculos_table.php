<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            // Agregar el campo 'año' como integer
            $table->integer('año')->nullable()->after('modelo');
        });
    }

    public function down()
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            // Eliminar el campo 'año' si se hace un rollback
            $table->dropColumn('año');
        });
    }
};

