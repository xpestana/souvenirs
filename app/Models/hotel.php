<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    use HasFactory;
    /**
     * Lista de atributos que pueden ser asignados masivamente
     *
     * @var array $fillable
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'address',
        'zone',
    ];

    /**
     * The users that belong to the role.
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
