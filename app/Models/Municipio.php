<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $primaryKey = 'id_municipio';
    
    // Desactivar timestamps automáticos
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_municipio',
        'fecha_creacion',
        'fecha_modificacion',        
        'estado',
    ];
}
