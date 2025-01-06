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
    Schema::create('historial_medico', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('medico_id');
        $table->unsignedBigInteger('paciente_id');
        $table->date('fecha');
        $table->text('descripcion');
        $table->text('tratamiento');
        $table->timestamps();

        // Claves foráneas
        $table->foreign('medico_id')->references('id')->on('medico')->onDelete('cascade');
        $table->foreign('paciente_id')->references('id')->on('paciente')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('historial_medico');
}

};
