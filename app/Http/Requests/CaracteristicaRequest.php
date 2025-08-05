<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaracteristicaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'placa_sena' => 'required|boolean',
            'descripcion' => 'required|boolean',
            'material_id' => 'required|exists:materiales,id_material',
        ];
    }
} 