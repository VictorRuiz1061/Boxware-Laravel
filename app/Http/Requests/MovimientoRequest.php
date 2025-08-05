<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'estado' => 'required|string|max:50',
            'cantidad' => 'required|integer',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date|nullable',
            'usuario_id' => 'required|exists:usuarios,id_usuario',
            'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
            'material_id' => 'required|exists:materiales,id_material',
            'sitio_id' => 'required|exists:sitios,id_sitio',
        ];
    }
} 