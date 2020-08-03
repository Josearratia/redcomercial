<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
  protected $fillable = ['id_cliente','id_producto_empresa','cantidad','total'];

  public function cliente(){
    return $this->belongsTo('App\Cliente');
}

public function pdempresa(){
    return $this->belongsTo('App\Pdempresa');
}
}
