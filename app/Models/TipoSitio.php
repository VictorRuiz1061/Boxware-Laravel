<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSitio extends Model
{
    protected $primaryKey = 'id_tipo_sitio';
    protected $table = 'tipos_sitio';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_tipo_sitio',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    public function sitios()
    {
        return $this->hasMany(Sitio::class, 'tipo_sitio_id', 'id_tipo_sitio');
    }
}
