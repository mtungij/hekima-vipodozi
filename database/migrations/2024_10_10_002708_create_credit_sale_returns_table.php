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
        Schema::create('credit_sale_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payment_method_id')->constrained()->restrictOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->restrictOnDelete();
            $table->decimal('amount', 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_sale_returns');
    }
};
