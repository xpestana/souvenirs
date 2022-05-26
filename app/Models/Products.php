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
        'category',
        'offer',
        'short_id',
        'summary',
        'title_en',
        'description_en'
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

    /* Método que obtiene los detalles de las actividades guardadas
    *
    * @author  Xavier Pestana 
    * @return object 
    */
    public function activities()
    {
        return $this->hasOne(Activities::class);
    }
        public function Shipping()
  {
    return $this->hasOne(Shipping::class);
  }
    
    /*
        Scopes
     */
    public function scopeSearch($query, $search) 
    {
        if ($search) {
            $search = collect(explode(' ', strtolower($search)))->each(function ($search) use ($query) {
                $query->WhereRaw('lower(products.title) like ?', ['%'.$search.'%']);
            });
        }
    }
    public function scopeCat($query, $cat) 
    {
        if ($cat) {
            $query->whereHas('categories', function($query) use ($cat) {
                $query->where('categories_id',  $cat);
            });
        }
    }
    public function scopePrice($query, $min, $max) 
    {
        if ($min != null) {
            $query->where('price','<=',$max)
                  ->where('price','>=',$min);
        }
    }
    public function scopePriceA($query, $min, $max) 
    {
        if ($min != null) {
           $query->whereHas('activities', function($query) use ($min, $max) {
                $query->where('priceA','<=',$max)
                    ->where('priceA','>=',$min);
            });
        }
    }
    public function scopeItems($query, $items) 
    {
        if ($items) {
            $query->where("products.type", $items);
        }
    }
    public function scopeSort($query, $sort) 
    {
        if ($sort) {
            if ($sort === 'latest') {
                $query->orderBy('products.created_at', 'desc');
            }
            if ($sort === 'price') {
                $query->orderBy('products.price', 'asc');
            }
        }
    }
}
