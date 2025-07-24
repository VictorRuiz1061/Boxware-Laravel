<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codigo_sena' => 'required|string|max:100',
            'nombre_material' => 'required|string|max:255',
            'descripcion_material' => 'required|string',
            'unidad_medida' => 'required|string|max:100',
            'producto_peresedero' => 'required|boolean',
            'estado' => 'required|boolean',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'required|string',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date|nullable',
        ];
    }
} 