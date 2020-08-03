<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdempresa extends Model
{
    protected $fillable = ['id_empresa','id_producto','stock','precio'];

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }

    public function producto(){
        return $this->hasMany('App\Producto');
    }

    public function vpdetalles() 
    {
        return $this->hasMany('App\Vpdetalle');//hacemos referencia a la tabla articulos de uno a muchos
    }

}
