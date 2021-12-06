<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'name',
        'url',
    ];

    /**
     * Get the products that owns the images.
     */
    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
