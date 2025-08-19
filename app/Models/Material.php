<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $primaryKey = 'id_material';
    protected $table = 'materiales';
    public $timestamps = false;
    
    protected $fillable = [
        'codigo_sena',
        'nombre_material',
        'descripcion_material',
        'unidad_medida',
        'producto_peresedero',
        'estado',
        'fecha_vencimiento',
        'imagen',
        'fecha_creacion',
        'fecha_modificacion',
        'tipo_material_id',
        'categoria_elemento_id',
    ];

    public function tipoMaterial()
    {
        return $this->belongsTo(TipoMaterial::class, 'tipo_material_id', 'id_tipo_material');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'material_id', 'id_material');
    }
    
    public function categoriaElemento()
    {
        return $this->belongsTo(CategoriaElemento::class, 'categoria_elemento_id', 'id_categoria_elemento');
    }
}
