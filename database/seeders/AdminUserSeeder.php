<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verifica se o usuário admin já existe
        if (DB::table('users')->where('email', 'admin@pereirareboques.com')->doesntExist()) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@pereirareboques.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'), // Senha do usuário 'admin_password'
                'remember_token' => Str::random(60), // Token de "lembrar-se" do usuário
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}