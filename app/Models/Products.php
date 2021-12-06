<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    /**
     * Lista de atributos que pueden ser asignados masivamente
     *
     * @var array $fillable
     */
    protected $fillable = [
        'type',
        'title',
        'description',
        'price',
        'stock',
        'featured',
        'init',
        'end',
    ];

    /**
     * The images that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class);
    }
    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}
