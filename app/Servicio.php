<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = ['id_categoria','nombre_servicio','descripcion'];
    
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
