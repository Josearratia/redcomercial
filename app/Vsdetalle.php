<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vsdetalle extends Model
{
    protected $fillable = ['id_venta','id_servicio_empresa','cantidad','precio'];

    public function venta(){
        return $this->belongsTo('App\Venta');
    }

    public function vpdetalle(){
        return $this->belongsTo('App\Vsdetalle');
    }
}
