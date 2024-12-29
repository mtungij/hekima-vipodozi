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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained()->restrictOnDelete();
            $table->dateTime('sale_date')->default(today());
            $table->date('due_date')->nullable();
            $table->string('status')->default('paid');
            $table->boolean('transportFee')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
