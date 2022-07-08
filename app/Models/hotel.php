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
        'image',
        'calle',
        'planta',
        'cp',
        'code',
        'url',
        'area',
        'hab',
        'modality',
        'group',
        'category',
        'province',
        'nllaves',
    ];

    /**
     * The users that belong to the role.
     */
    public function user()
    {
        return $this->belongsToMany(User::class)->withPivot('manager');
    }
    public function orders()
    {
        return $this->hasMany(Order::class)->where("status","complete");
    }

     /*
        Scopes
     */
    public function scopeSearch($query, $search) 
    {
        if ($search) {
            $query->where('name','like',  ['%'.$search.'%']);
            $query->orWhere('address','like',  ['%'.$search.'%']);
            $query->orWhere('calle','like',  ['%'.$search.'%']);
            $query->orWhere('planta','like',  ['%'.$search.'%']);
            $query->orWhere('province','like',  ['%'.$search.'%']);
        }
    }
    public function scopeType($query, $type) 
    {
        if ($type) {
            $query->where('type',$type);
        }
    }
}
