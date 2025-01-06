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
    Schema::create('medicos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('nombre');
        $table->string('especialidad');
        $table->string('telefono');
        $table->string('email')->unique();
        $table->timestamps();

        // Define la clave foránea
        $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');
    });
}

};
