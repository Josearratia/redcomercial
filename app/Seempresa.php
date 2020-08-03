<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seempresa extends Model
{
    protected $fillable = ['id_empresa','id_servicio','precio'];

    
    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }

    public function servicio(){
        return $this->hasMany('App\Servicio');
    }

    public function vsedetalle() 
    {
        return $this->hasMany('App\Vsdetalle');//hacemos referencia a la tabla articulos de uno a muchos
    }
}
