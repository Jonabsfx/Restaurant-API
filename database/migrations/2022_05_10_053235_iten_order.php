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
        Schema::create('iten_order', function(Blueprint $table){
            $table->id();
            $table->foreignUuid('iten_id')->nullable(false)->constrained('itens')->index();
            $table->foreignUuid('order_id')->nullable(false)->constrained('orders')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iten_order');
    }
};
