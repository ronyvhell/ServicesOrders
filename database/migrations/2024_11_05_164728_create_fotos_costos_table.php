<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fotos_costos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained()->onDelete('cascade');
            $table->string('foto_frente')->nullable();
            $table->string('foto_lateral_izquierdo')->nullable();
            $table->string('foto_lateral_derecho')->nullable();
            $table->string('foto_atras')->nullable();
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos_costos');
    }
};
