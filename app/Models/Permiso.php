<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $primaryKey = 'id_permiso';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
    
    protected $fillable = [
        'nombre',
        'estado',
        'puede_ver',
        'puede_crear',
        'puede_editar',
        'modulo_id',
        'rol_id',
    ];

    public function modulo()
    {
        return $this->belongsTo(\App\Models\Modulo::class, 'modulo_id', 'id_modulo');
    }

    public function rol()
    {
        return $this->belongsTo(\App\Models\Rol::class, 'rol_id', 'id_rol');
    }
}
