<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
use App\Notifications\ResetPassword;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
     use Billable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     /**
  * Método que obtiene el perfil del cliente y del operador
  *
  * @author  Xavier Pestana 
  * @return object 
  */
    public function profile()
  {
    return $this->hasOne(profile::class);
  }

  /**
     * The hotels that belong to the user.
     */
    public function hotel()
    {
        return $this->belongsToMany(hotel::class)->withPivot('manager');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function collaboratorShippings()
    {
        return $this->hasMany(CollaboratorShipping::class);
    }


    /*
        Scopes
     */
    public function scopeSearch($query, $search) 
    {
        if ($search) {
             $query->whereHas('profile', function($query) use ($search) {
                $query->where('firstname','like',  ['%'.$search.'%']);
                $query->orWhere('lastname','like', ['%'.$search.'%']);
            });
        }
    }
    public function scopeEmail($query, $email, $roll) 
    {
        if ($email && $roll =="Hotel") {
            $query->orWhere("email",'like',  '%'.$email.'%');
            $query->role('Hotel');
        }
        if ($email && $roll =="Admin") {
            $query->orWhere("email",'like',  '%'.$email.'%');
            $query->role('Admin');
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
