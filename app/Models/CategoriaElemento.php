<?php

// app/Models/CategoriaElemento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaElemento extends Model
{
    protected $table = 'categorias_elementos';
    protected $primaryKey = 'id_categoria_elemento';
    public $timestamps = false;

    protected $fillable = [
        'codigo_qnpsc',
        'nombre_categoria',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];
}
