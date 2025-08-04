<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $primaryKey = 'id_area';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_area',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'id_sede', // <--- CORRECTO
    ];
    
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }

    public function programas()
    {
        return $this->hasMany(Programa::class, 'area_id', 'id_area');
    }
}
