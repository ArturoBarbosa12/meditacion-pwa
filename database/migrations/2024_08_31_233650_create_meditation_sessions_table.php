<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meditation_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Llave foránea a la tabla de usuarios
            $table->foreignId('theme_id')->constrained('meditation_themes')->onDelete('cascade'); // Llave foránea a la tabla de temas de meditación
            $table->integer('duration'); // Duración de la sesión en minutos
            $table->timestamp('start_time')->nullable(); // Hora de inicio de la sesión
            $table->timestamp('end_time')->nullable(); // Hora de fin de la sesión
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meditation_sessions');
    }
};
