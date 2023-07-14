<?php // CompanyWithVue\app\Models\Sector.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model // Classe que representa a tabela de setores
{
    use HasFactory; // Trait que adiciona métodos de criação de factories para o modelo
    protected $fillable = ['name']; // Atributo que pode ser preenchido em massa
}

