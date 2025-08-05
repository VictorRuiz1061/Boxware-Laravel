<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuloRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fecha_accion' => 'nullable|date',
            'rutas' => 'required|string|max:255',
            'descripcion_ruta' => 'required|string|max:255',
            'mensaje_cambio' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'sometimes|date',
            'es_submenu' => 'required|boolean',
            'modulo_padre_id' => 'nullable|exists:modulos,id_modulo',
        ];
    }
} 