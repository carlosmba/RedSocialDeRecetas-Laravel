<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Evento que se ejecuta una vez que el usuario es creado

     protected static function boot()
    {

        parent::boot();
        //Asignar perfil una vez que se haya creado un usuario nuevo
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }


    //Relacion de 1:N de Usuarios a Recetas

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    //Relacion de 1:1 de Usuarios a perfiles
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }


    //Recetas que el usuario le a dado me gusta
    public function iLike()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}
