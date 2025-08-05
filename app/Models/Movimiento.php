<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $primaryKey = 'id_movimiento';
    protected $table = 'movimientos';
    public $timestamps = false;
    
    protected $fillable = [
        'estado',
        'cantidad',
        'fecha_creacion',
        'fecha_modificacion',
        'usuario_id',
        'tipo_movimiento_id',
        'material_id',
        'sitio_id',
    ];

    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_movimiento_id', 'id_tipo_movimiento');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }

    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'sitio_id', 'id_sitio');
    }
}
