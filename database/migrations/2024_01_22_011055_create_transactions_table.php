<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['dikeranjang', 'dibayar', 'diambil']);
            $table->string('order_code');
            $table->double('price');
            $table->integer('quantity');
            $table->foreignId('products_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('users_id')->constrained()->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
