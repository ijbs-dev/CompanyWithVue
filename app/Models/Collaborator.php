<?php // CompanyWithVue\app\Models\Collaborator.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model // Classe que representa a tabela de colaboradores
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'sector_id']; // Atributo que pode ser preenchido em massa
}
