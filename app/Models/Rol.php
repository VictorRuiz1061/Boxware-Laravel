<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    public $timestamps = false;

    protected $fillable = [
        'nombre_rol',
        'descripcion',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rol_id', 'id_rol');
    }
}