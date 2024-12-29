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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->after('company_id')->constrained()->cascadeOnDelete();
            $table->boolean('isAdmin')->default(value: true)->after('email');
            $table->string('phone')->unique()->nullable()->after('isAdmin');
            $table->string('role')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
            $table->dropConstrainedForeignId('branch_id');
            $table->dropColumn(['isAdmin', 'phone', 'avatar', 'role']);
        });
    }
};
