<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'firstname',
        'lastname',
        'email',
        'address',
        'company',
        'apart',
        'city',
        'state',
        'zip_code',
        'phone',
        'amount',
        'adult',
        'children',
        'date_init',
        'date_end',
        'hab',
        'observations',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
    /*
    *Scopes
     */
    
    public function scopeStatus($query) 
    {
         $query->whereHas('order', function($query) {
            $query->where('status', "complete");
        });
    }
}
