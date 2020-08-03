<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email' ,'password', 'condicion', 'rol'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function vendedores() 
    {
        return $this->hasMany('App\Vendedor');//hacemos referencia a la tabla articulos de uno a muchos
    }

    public function clientes() 
    {
        return $this->hasMany('App\Cliente');//hacemos referencia a la tabla articulos de uno a muchos
    }

   

}
