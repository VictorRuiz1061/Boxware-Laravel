<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    protected $primaryKey = 'id_tipo_movimiento';
    protected $table = 'tipos_movimiento';
    public $timestamps = false;
    
    protected $fillable = [
        'tipo_movimiento',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'tipo_movimiento_id', 'id_tipo_movimiento');
    }
}
