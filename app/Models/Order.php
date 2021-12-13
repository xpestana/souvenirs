<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'total',
    ];

    /**
     * Get the images for the product.
     */
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
