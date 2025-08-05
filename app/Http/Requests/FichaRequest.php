<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'estado' => 'required|string|max:50',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date|nullable',
            'usuario_id' => 'required|exists:usuarios,id_usuario',
            'programa_id' => 'required|exists:programas,id_programa',
        ];
    }
} 