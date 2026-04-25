<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel category baru
     */
    public function up(): void
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            // Nama category harus unik
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel category
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};