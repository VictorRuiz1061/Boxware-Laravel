<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $primaryKey = 'id_sitio';
    protected $table = 'sitios';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_sitio',
        'ubicacion',
        'fecha_tecnica',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'tipo_sitio_id',
    ];

    public function tipoSitio()
    {
        return $this->belongsTo(TipoSitio::class, 'tipo_sitio_id', 'id_tipo_sitio');
    }
}
