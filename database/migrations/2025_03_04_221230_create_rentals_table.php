<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar a tabela rentals
        Schema::create('rentals', function (Blueprint $table) {
            $table->id(); // Criação da chave primária id
            $table->date('rental_date'); // Data de aluguel
            $table->date('return_date'); // Data de devolução
            $table->date('actual_return_date')->nullable(); // Data real de devolução
            $table->decimal('deposit_value', 15, 2)->nullable(); // Valor do depósito
            $table->decimal('contract_original_value', 15, 2); // Valor original do contrato
            $table->decimal('advance_value', 15, 2)->nullable(); // Valor adiantado
            $table->decimal('extra_value', 15, 2)->nullable(); // Valor extra
            $table->decimal('discount', 15, 2)->nullable(); // Desconto
            $table->string('status', 15)->comment('active, completed, canceled'); // Status do aluguel
            $table->unsignedBigInteger('user_id'); // Relacionamento com a tabela users
            $table->timestamps(); // Criação das colunas created_at e updated_at
            $table->unsignedBigInteger('trailer_id'); // Relacionamento com a tabela trailers
            $table->unsignedBigInteger('customer_id'); // Relacionamento com a tabela customers
            $table->string('observation_return', 500)->nullable(); // Observações sobre a devolução

            // Chave estrangeira para a tabela users
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            // Chave estrangeira para a tabela trailers
            $table->foreign('trailer_id')
                ->references('id')->on('trailers')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            // Chave estrangeira para a tabela customers
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            // Índices para as colunas user_id, trailer_id e customer_id
            $table->index('user_id');
            $table->index('trailer_id');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover a tabela rentals
        Schema::dropIfExists('rentals');
    }
}