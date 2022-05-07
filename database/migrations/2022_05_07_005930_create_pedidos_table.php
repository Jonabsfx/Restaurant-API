<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('data');
            $table->enum('status', ['P', 'A', 'F'])->default('P');
            /** P -> A fazer, A -> Em Andamento, F -> Finalizado */
            $table->foreignUuid('funcionario_id')->nullable(false)->index();
            $table->foreignUuid('mesa_id')->nullable(false)->index();
            $table->foreignUuid('cliente_id')->nullable(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
