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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('data');
            $table->enum('status', ['P', 'A', 'F'])->default('P');
            /** P -> A fazer, A -> Em Andamento, F -> Finalizado */
            $table->foreignUuid('employee_id')->nullable(false)->index();
            $table->foreignUuid('table_id')->nullable(false)->index();
            $table->foreignUuid('customer_id')->nullable(false)->index();
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
        Schema::dropIfExists('orders');
    }
};
