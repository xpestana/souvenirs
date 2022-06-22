<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaboratorShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document',
        'businessName',
        'contactPerson',
        'phone',
        'email',
        'deliveryAddress',
        'province',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
