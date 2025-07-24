<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    } 

    public function rules()
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer',
            'cedula' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'fecha_registro' => 'required|date',
            'rol_id' => 'required|exists:roles,id_rol',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|string|max:255'
        ];

        // Si es una actualización (PUT/PATCH)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Email único excepto para el usuario actual
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                Rule::unique('usuarios')->ignore($this->route('usuario'), 'id_usuario')
            ];
            
            // Contraseña opcional en actualizaciones
            $rules['password'] = 'nullable|string|min:6';
        } else {
            // Para creación (POST)
            $rules['email'] = 'required|email|max:255|unique:usuarios,email';
            $rules['password'] = 'required|string|min:6';
        }

        return $rules;
    }
}