<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_centro' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date|nullable',
            'municipio_id' => 'required|exists:municipios,id_municipio',
        ];
    }
} 