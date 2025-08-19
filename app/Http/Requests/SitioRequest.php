<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SitioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_sitio' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'ficha_tecnica' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date|nullable',
            'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
        ];
    }
} 