<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $primaryKey = 'id_programa';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_programa',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'area_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id_area');
    }
}
