<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'total',
        'ryder_id',
        'hotel_id',
        'Ds_SignatureVersion',
        'Ds_MerchantParameters',
        'Ds_Signature',
        'status',
        'total_s',
        'shipping'
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
    public function hotel()
    {
        return $this->belongsTo(hotel::class);
    }

     /*
        Scopes
     */
    public function scopeDate($query, $desde, $hasta) 
    {
        if ($desde && $hasta) {
            $desde = Carbon::parse($desde)->addDay(1);
            $hasta = Carbon::parse($hasta)->addDay(1);
            $query->whereDate('created_at',">=", $desde)
                ->whereDate('created_at',"<=", $hasta);
        }
    }
}
