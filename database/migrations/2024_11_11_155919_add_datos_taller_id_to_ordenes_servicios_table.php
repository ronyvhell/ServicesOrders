<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('ordenes_servicios', function (Blueprint $table) {
        $table->foreignId('datos_taller_id')->nullable()->constrained('datos_taller')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('ordenes_servicios', function (Blueprint $table) {
        $table->dropForeign(['datos_taller_id']);
        $table->dropColumn('datos_taller_id');
    });
}

};
