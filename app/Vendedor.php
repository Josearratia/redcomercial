<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $primarkey = 'id';
    protected $fillable = ['id_usuario','nombres','apellidos'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    
    public function empresa() 
    {
        return $this->hasMany('App\Empresa');//hacemos referencia a la tabla articulos de uno a muchos
    }

    public function ventas() 
    {
        return $this->hasMany('App\Venta');//hacemos referencia a la tabla articulos de uno a muchos
    }
}
