<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Empresa extends Model
{
    protected $fillable = ['id_vendedor','nombre_empresa','pais','ciudad','latitud','longitud'];

    public function vendedor(){
        return $this->belongsTo('App\Vendedor');
    }

    public function pdempresa(){
        return $this->hasMany('App\Pdempresa');
    }

    public function seempresa(){
        return $this->hasMany('App\Seempresa');
    }
}
