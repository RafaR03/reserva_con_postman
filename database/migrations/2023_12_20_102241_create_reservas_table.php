<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora');
            $table->string('tarjeta_credito');
            $table->integer('numero_personas');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        //
    }
};
