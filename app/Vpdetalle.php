<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vpdetalle extends Model
{
    protected $fillable  = ['id_venta','id_producto_empresa','cantidad','precio'];

    public function venta(){
        return $this->belongsTo('App\Venta');
    }

    public function vpdetalle(){
        return $this->belongsTo('App\Vpdetalle');
    }


}
