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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('unit')->default('each');
            $table->decimal('buy_price',11,2);
            $table->decimal('sale_price',11,2);
            $table->decimal('whole_price',11,2)->default(0);
            $table->decimal('stock');
            $table->decimal('stock_alert')->default(0);
            $table->decimal('whole_stock',11,2)->default(0);
            $table->date('expire_date')->nullable();
            $table->decimal('transport', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
