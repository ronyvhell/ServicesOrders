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
        $table->text('notas')->nullable()->change();
    });
}

public function down()
{
    Schema::table('ordenes_servicios', function (Blueprint $table) {
        $table->text('notas')->nullable(false)->change();
    });
}

};
