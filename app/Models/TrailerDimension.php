<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrailerDimension extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'trailer_dimensions';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'length',
        'width',
        'height',
        'max_load_capacity',
        'daily_rate',
        'daily_rate_description',
        'user_id',
        'created_at',
        'updated_at',
    ];

    // Relações
    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'dimension_id');
    }
}