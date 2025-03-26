<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar a tabela insurers
        Schema::create('insurers', function (Blueprint $table) {
            $table->id(); // Criação da chave primária id
            $table->string('name', 60); // Nome da seguradora
            $table->timestamps(); // Criação das colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover a tabela insurers
        Schema::dropIfExists('insurers');
    }
}