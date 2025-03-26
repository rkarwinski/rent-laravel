<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'rentals';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'rental_date',
        'return_date',
        'actual_return_date',
        'deposit_value',
        'contract_original_value',
        'advance_value',
        'extra_value',
        'discount',
        'status',
        'user_id',
        'created_at',
        'updated_at',
        'trailer_id',
        'customer_id',
        'observation_return',
    ];

    // Relações
    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}