<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // kolom yang boleh diisi
    protected $fillable = ['user_id', 'title'];

    /**
     * category dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * category bisa punya banyak Todo
     */
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}