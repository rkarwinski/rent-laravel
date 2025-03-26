<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'trailers';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'title',
        'chassis',
        'model',
        'manufacturing_date',
        'licence_plate',
        'brand',
        'wheel_size',
        'dimension_id',
        'capacity',
        'color',
        'axle_count',
        'vehicle_type',
        'user_id',
        'created_at',
        'updated_at',
    ];

    // Relações
    public function trailerDimension()
    {
        return $this->belongsTo(TrailerDimension::class, 'dimension_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}