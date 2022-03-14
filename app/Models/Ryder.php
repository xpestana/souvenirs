<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ryder extends Model
{
    use HasFactory;
    /**
     * Lista de atributos que pueden ser asignados masivamente
     *
     * @var array $fillable
     */
    protected $fillable = [
        'profile_id',
        'address',
        
    ];

    /**
     * Método que obtiene el usuario asociado al perfil
     *
     * @author  
     * @return object 
     */
    public function profile()
    {
        return $this->belongsTo(profile::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
