<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * The users that belong to the role.
     */
    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
}
