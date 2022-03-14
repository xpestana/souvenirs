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
        'ryder_id',
    ];

    /**
     * Get the images for the product.
     */
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ryder()
    {
        return $this->belongsTo(Ryder::class);
    }
}
