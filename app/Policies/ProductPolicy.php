<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // Semua boleh lihat
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Product $product): bool
    {
        return true;
    }

    // Hanya admin bisa create
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    // 🔥 ADMIN + HARUS PUNYA PRODUKNYA
    public function update(User $user, Product $product): bool
    {
        return $user->role === 'admin'
            && $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin'
            && $user->id === $product->user_id;
    }
}