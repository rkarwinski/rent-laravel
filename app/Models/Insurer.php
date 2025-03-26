<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'insurers';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
    ];

    // Relações
    public function insurerValues()
    {
        return $this->hasMany(InsurerValue::class);
    }
}