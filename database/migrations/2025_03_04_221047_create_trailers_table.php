<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar a tabela trailers
        Schema::create('trailers', function (Blueprint $table) {
            $table->id(); // Criação da chave primária id
            $table->string('title', 220); // Título do trailer
            $table->string('chassis', 150); // Chassi
            $table->string('model', 8); // Modelo
            $table->string('manufacturing_date', 8)->nullable(); // Data de fabricação
            $table->string('licence_plate', 20)->nullable(); // Placa do trailer
            $table->string('brand', 120)->nullable(); // Marca
            $table->smallInteger('wheel_size')->nullable(); // Tamanho da roda
            $table->unsignedBigInteger('dimension_id'); // Relacionamento com a tabela trailer_dimensions
            $table->float('capacity')->nullable(); // Capacidade
            $table->string('color', 20)->nullable(); // Cor
            $table->smallInteger('axle_count')->nullable(); // Contagem de eixos
            $table->string('vehicle_type', 1)->nullable()->comment('R = Reboque, T = Trailer, C = Carro'); // Tipo de veículo
            $table->unsignedBigInteger('user_id')->nullable(); // Relacionamento com a tabela users
            $table->timestamps(); // Criação das colunas created_at e updated_at

            // Chave estrangeira para a tabela users
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            // Chave estrangeira para a tabela trailer_dimensions
            $table->foreign('dimension_id')
                ->references('id')->on('trailer_dimensions')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            // Índices para as colunas user_id e dimension_id
            $table->index('user_id');
            $table->index('dimension_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover a tabela trailers
        Schema::dropIfExists('trailers');
    }
}