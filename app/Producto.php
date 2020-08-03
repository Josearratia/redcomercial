<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['id_categoria','nombre_producto','imagen_producto'];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
