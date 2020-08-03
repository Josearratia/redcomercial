<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['id_usuario','nombres','apellidos','pais','ciudad','email'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function ventas() 
    {
        return $this->hasMany('App\Venta');//hacemos referencia a la tabla articulos de uno a muchos
    }
}
