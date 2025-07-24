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
        'sitio_id',
    ];

    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'sitio_id', 'id_sitio');
    }
}
