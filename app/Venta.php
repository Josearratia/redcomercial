<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['id_vendedor','id_cliente','total'];

    public function vendedor(){
        return $this->belongsTo('App\Vendedor');
    }

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }
    
}
