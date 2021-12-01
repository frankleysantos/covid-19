<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteVacinadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_vacinados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacina_id');
            $table->foreign('vacina_id')
                    ->references('id')
                    ->on('vacinas')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')
                    ->references('id')
                    ->on('pacientes')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente_vacinados');
    }
}
