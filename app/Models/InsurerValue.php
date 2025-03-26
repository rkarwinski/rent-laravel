<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurerValue extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'insurer_values';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'insurer_id',
        'age_range',
        'state_value',
    ];

    // Relações
    public function insurer()
    {
        return $this->belongsTo(Insurer::class, 'insurer_id');
    }
}