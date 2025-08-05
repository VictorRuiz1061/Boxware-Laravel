<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $primaryKey = 'id_modulo';
    public $timestamps = false;
    
    protected $fillable = [
        'fecha_accion',
        'rutas',
        'descripcion_ruta',
        'mensaje_cambio',
        'imagen',
        'estado',
        'fecha_creacion',
        'es_submenu',
        'modulo_padre_id'
    ];
    
    // Relación consigo mismo para los submódulos
    public function submodulos()
    {
        return $this->hasMany(Modulo::class, 'modulo_padre_id', 'id_modulo');
    }
    
    // Relación con el módulo padre
    public function moduloPadre()
    {
        return $this->belongsTo(Modulo::class, 'modulo_padre_id', 'id_modulo');
    }
}
