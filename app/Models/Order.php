<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'productId',
        'email',
        'price',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
