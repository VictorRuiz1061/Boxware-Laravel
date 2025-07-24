<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $primaryKey = 'id_permiso';
    protected $fillable = [
        'nombre',
        'estado',
        'puede_ver',
        'puede_crear',
        'puede_editar',
        'fecha_creacion',
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
