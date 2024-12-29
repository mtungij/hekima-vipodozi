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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->decimal('qty', 6)->default(0);
            $table->decimal('buy_price', 11);
            $table->decimal('price', 11);
            $table->decimal('transport')->default(0);
            $table->decimal('total', 11)->virtualAs('qty * price');
            $table->decimal('total_transport', 11)->virtualAs('qty * transport');
            $table->decimal('profit', 11)->virtualAs('(price - buy_price) * qty');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
