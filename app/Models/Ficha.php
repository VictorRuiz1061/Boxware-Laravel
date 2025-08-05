<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $primaryKey = 'id_ficha';
    protected $fillable = [
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'usuario_id',
        'programa_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id', 'id_programa');
    }
}
