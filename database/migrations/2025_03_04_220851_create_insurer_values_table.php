<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurerValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar a tabela insurer_values
        Schema::create('insurer_values', function (Blueprint $table) {
            $table->id(); // Criação da chave primária id
            $table->unsignedBigInteger('insurer_id'); // Relacionamento com a tabela insurers
            $table->string('age_range', 30); // Faixa etária
            $table->decimal('state_value', 15, 4); // Valor associado à seguradora
            $table->timestamps(); // Criação das colunas created_at e updated_at

            // Definindo chave estrangeira
            $table->foreign('insurer_id')
                ->references('id')->on('insurers') // Relacionamento com a tabela insurers
                ->onDelete('NO ACTION') // Ação no caso de delete
                ->onUpdate('NO ACTION'); // Ação no caso de update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover a tabela insurer_values
        Schema::dropIfExists('insurer_values');
    }
}