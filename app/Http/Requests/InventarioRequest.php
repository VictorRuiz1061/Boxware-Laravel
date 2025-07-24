<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stock' => 'required|integer',
            'placa_sena' => 'required|string',
            'descripcion' => 'required|string',
            'sitio_id' => 'required|exists:sitios,id_sitio',
        ];
    }
} 