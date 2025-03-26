<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailerDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar a tabela trailer_dimensions
        Schema::create('trailer_dimensions', function (Blueprint $table) {
            $table->id(); // Criação da chave primária id
            $table->double('length'); // Comprimento
            $table->double('width'); // Largura
            $table->double('height'); // Altura
            $table->double('max_load_capacity', 45, 2); // Capacidade máxima de carga
            $table->double('daily_rate'); // Taxa diária
            $table->string('daily_rate_description'); // Descrição da taxa diária
            $table->unsignedBigInteger('user_id'); // Relacionamento com a tabela users
            $table->timestamps(); // Criação das colunas created_at e updated_at

            // Chave estrangeira para a tabela users
            $table->foreign('user_id')
                ->references('id')->on('users') // Relacionamento com a tabela users
                ->onDelete('CASCADE') // Se o usuário for deletado, os trailers também são deletados
                ->onUpdate('CASCADE'); // Se o id do usuário for alterado, também altera a fk na tabela trailer_dimensions

            // Índice para a coluna user_id
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover a tabela trailer_dimensions
        Schema::dropIfExists('trailer_dimensions');
    }
}