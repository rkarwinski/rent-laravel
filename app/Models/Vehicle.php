<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'customer_vehicles';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'customer_id',
        'vehicle_model',
        'manufacturer',
        'year_of_manufacture',
        'license_plate',
        'chassis',
        'renavan',
    ];

    // Relações
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}