<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre_categoria','descripcion_categoria','condicion'];

    public function articulos() 
    {
        return $this->hasMany('App\Producto');//hacemos referencia a la tabla articulos de uno a muchos
    }

    public function servicios() 
    {
        return $this->hasMany('App\Servicio');//hacemos referencia a la tabla articulos de uno a muchos
    }
}
