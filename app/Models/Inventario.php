<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $primaryKey = 'id_inventario';
    protected $table = 'inventario';
    public $timestamps = false;
    
    protected $fillable = [
        'stock',
        'placa_sena',
        'descripcion',
        'material_id',
        'sitio_id',
    ];

    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'sitio_id', 'id_sitio');
    }
    
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }
}
