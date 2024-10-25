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
        Schema::create('user_affirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Llave foránea a la tabla de usuarios
            $table->foreignId('affirmation_id')->constrained()->onDelete('cascade'); // Llave foránea a la tabla de afirmaciones
            $table->timestamp('viewed_at')->nullable(); // Columna para registrar cuándo se vio la afirmación
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
        Schema::dropIfExists('user_affirmations');
    }
};
