<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $primaryKey = 'id_caracteristica';
    protected $table = 'caracteristicas';
    public $timestamps = false;
    
    protected $fillable = [
        'placa_sena',
        'descripcion',
        'material_id',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }
}
