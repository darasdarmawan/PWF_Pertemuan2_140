<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom category_id ke tabel products
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Nullable karena product boleh tidak punya category
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('category')->cascadeOnDelete();
        });
    }

    /**
     * Hapus kolom category_id dari tabel products
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};