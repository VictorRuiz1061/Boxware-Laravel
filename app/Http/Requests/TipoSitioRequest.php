<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoSitioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_tipo_sitio' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date|nullable',
        ];
    }
} 