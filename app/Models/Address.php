<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'addresses';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'customer_id',
        'address',
        'number',
        'zip_code',
        'complement',
        'neighbourhood',
    ];

    // Relações
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}