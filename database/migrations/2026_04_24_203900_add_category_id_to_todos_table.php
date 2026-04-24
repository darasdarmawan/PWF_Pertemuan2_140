<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * tambah kolom category_id ke tabel todos
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // nullable karena todo boleh tidak punya category
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * hapus kolom category_id dari tabel todos
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeignIdFor('category_id');
        });
    }
};