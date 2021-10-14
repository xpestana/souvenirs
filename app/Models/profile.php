<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    /**
     * Lista de atributos que pueden ser asignados masivamente
     *
     * @var array $fillable
     */
    protected $fillable = [
        'user_id',
        'hotel_id',
    ];

    /**
     * Método que obtiene el usuario asociado al perfil
     *
     * @author  
     * @return object 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Método que obtiene el usuario asociado al perfil
     *
     * @author  
     * @return object 
     */
    public function hotel()
    {
        return $this->belongsTo(hotel::class);
    }
}
