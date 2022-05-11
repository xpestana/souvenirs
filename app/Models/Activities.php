<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;
    /**
     * Lista de atributos que pueden ser asignados masivamente
     *
     * @var array $fillable
     */
    protected $fillable = [
        'product_id',
        'priceA',
        'priceN',
        'init',
        'end',
        'details',
        'iframe',
        'duration',
        'flow',
        'coordinates',
        'events',
        'price_notes',
        'language',
    ];

    /**
     * Método que obtiene el los detalles de las actividades guardadas
     *
     * @author  
     * @return object 
     */
    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
