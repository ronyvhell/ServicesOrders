<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToTotalInOrdenesServiciosTable extends Migration
{
    public function up()
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->nullable(false)->change(); // Revertir cambio si es necesario
        });
    }
}
