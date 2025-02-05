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
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->string('estado', 50)->change(); // Cambia a VARCHAR(50)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->integer('estado')->change(); // Cambia a su tipo anterior, ajusta si era distinto
        });
    }
};
