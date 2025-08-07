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
        'fecha_creacion',
        'fecha_modificacion',
        'municipio_id',        
        'estado',
    ];
} 