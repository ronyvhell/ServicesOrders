<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToIvaInOrdenesServiciosTable extends Migration
{
    public function up()
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->decimal('iva', 10, 2)->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->decimal('iva', 10, 2)->nullable(false)->change(); // Revertir el cambio si es necesario
        });
    }
}
