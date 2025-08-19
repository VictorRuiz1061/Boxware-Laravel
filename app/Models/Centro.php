<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $table = 'centros';
    protected $primaryKey = 'id_centro';
    public $timestamps = false;

    protected $fillable = [
        'nombre_centro',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'municipio_id',
    ];

    public function municipio()
    {
        return $this->belongsTo(\App\Models\Municipio::class, 'municipio_id', 'id_municipio');
    }
} 