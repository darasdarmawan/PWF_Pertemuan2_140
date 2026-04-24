<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // kolom yang boleh diisi
    protected $fillable = ['user_id', 'category_id', 'title', 'is_done'];

    /**
     * todo dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * todo dimiliki oleh satu Category (opsional)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}