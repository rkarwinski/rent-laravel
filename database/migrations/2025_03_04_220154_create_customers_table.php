<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar a tabela customer_vehicles
        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Cliente ao qual o veículo pertence
            $table->string('vehicle_model');
            $table->string('manufacturer');
            $table->string('year_of_manufacture');
            $table->string('license_plate');
            $table->string('chassis');
            $table->string('renavan');
            $table->timestamps();

            // Índices
            $table->index('vehicle_model', 'BY_VEHICLE_MODEL');
            $table->index('manufacturer', 'BY_MANUFACTURER');
            $table->index('year_of_manufacture', 'BY_YEAR_OF_MANUFACTURE');
            $table->index('license_plate', 'BY_LICENSE_PLATE');
            $table->index('chassis', 'BY_CHASSIS');
            $table->index('renavan', 'BY_RENAVAN');
        });

        // Criar a tabela addresses
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Cliente ao qual o endereço pertence
            $table->string('address', 120);
            $table->smallInteger('number');
            $table->string('zip_code', 15)->nullable();
            $table->string('complement', 60)->nullable();
            $table->string('neighbourhood', 100)->nullable();
            $table->timestamps();
        });

        // Criar a tabela customers
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('birth_date');
            $table->enum('document_type', ['CNH', 'CPF', 'RG', 'PASSAPORTE', 'CNPJ']);
            $table->string('document_number', 20);
            $table->string('cnh_number', 30);
            $table->date('cnh_expiration');
            $table->string('phone', 20);
            $table->string('phone_secondary', 20)->nullable();
            $table->string('observations', 240)->nullable();
            $table->string('user_code', 10)->nullable();
            $table->timestamps();

            // Relacionamentos
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();

            // Definindo chaves estrangeiras
            $table->foreign('address_id')->references('id')->on('addresses')
                ->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->foreign('vehicle_id')->references('id')->on('customer_vehicles')
                ->onDelete('CASCADE')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('customer_vehicles');
    }
}