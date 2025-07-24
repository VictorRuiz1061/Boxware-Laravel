<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo_nombre' => 'required|string|max:100',
            'estado' => 'required|boolean',
            'puede_ver' => 'required|boolean',
            'puede_crear' => 'required|boolean',
            'puede_editar' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'modulo_id' => 'required|exists:modulos,id_modulo',
            'rol_id' => 'required|exists:roles,id_rol',
        ];
    }
} 