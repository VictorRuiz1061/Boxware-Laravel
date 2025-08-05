<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{
    protected $primaryKey = 'id_tipo_material';
    protected $table = 'tipo_materiales';
    public $timestamps = false;
    
    protected $fillable = [
        'tipo_elemento',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];
    
    public function materiales()
    {
        return $this->hasMany(Material::class, 'tipo_material_id', 'id_tipo_material');
    }
}
