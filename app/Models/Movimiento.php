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
        'sitio_id',
        'sitio_origen_id',
        'sitio_destino_id',
        'usuario_id',
        'tipo_movimiento_id',
        'material_id',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'fecha_modificacion' => 'datetime',
    ];

    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_movimiento_id', 'id_tipo_movimiento');
    }

    public function usuarioMovimiento()
    {
        return $this->belongsTo(Usuario::class, 'usuario_movimiento_id', 'id_usuario');
    }

    public function usuarioResponsable()
    {
        return $this->belongsTo(Usuario::class, 'usuario_responsable_id', 'id_usuario');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }

    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'sitio_id', 'id_sitio');
    }

    public function sitioOrigen()
    {
        return $this->belongsTo(Sitio::class, 'sitio_origen_id', 'id_sitio');
    }

    public function sitioDestino()
    {
        return $this->belongsTo(Sitio::class, 'sitio_destino_id', 'id_sitio');
    }
}
