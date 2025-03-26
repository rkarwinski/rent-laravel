<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Definindo a tabela associada a esse modelo
    protected $table = 'customers';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'name',
        'birth_date',
        'document_type',
        'document_number',
        'cnh_number',
        'cnh_expiration',
        'phone',
        'phone_secondary',
        'observations',
        'user_code',
        'created_at',
        'updated_at',
        'address_id',
        'vehicle_id',
    ];

    public function address()
    {
        return $this->hasOne(Address::class, 'customer_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'customer_id');
    }
}