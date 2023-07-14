<?php // CompanyWithVue\database\migrations\2023_07_11_204051_create_collaborators_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     *
     */
    public function up(): void
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->string('name', 160); // Nome do colaborador com no máximo 160 caracteres
            $table->string('email', 90)->unique(); // E-mail do colaborador com no máximo 90 caracteres
            $table->string('phone', 25); // Telefone do colaborador com no máximo 25 caracteres

            $table->foreignId('sector_id')
            ->constrained('sectors')
            ->onUpdate('cascade')
            ->onDelete('restrict'); // Chave estrangeira para o setor

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }
};
