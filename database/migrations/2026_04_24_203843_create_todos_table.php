<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * membuat tabel todos baru
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            // foreign key ke tabel users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            // status todo: false = ongoing, true = complete
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * hapus tabel todos
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};