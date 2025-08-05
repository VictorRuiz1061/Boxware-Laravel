<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
{
    public function authorize()
    {
<<<<<<< HEAD
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
=======
        // Aquí puedes colocar lógica para autorizar (por roles, por ejemplo).
        return true;
    }

    public function rules()
    {
        $usuarioId = $this->route('usuario'); // Asume que la ruta tiene {usuario}

        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'cedula' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'fecha_registro' => 'sometimes|date',
            'rol_id' => 'required|exists:roles,id_rol',
            'estado' => 'required|boolean',
            'imagen' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
>>>>>>> master
            $rules['email'] = [
                'required',
                'email',
                'max:255',
<<<<<<< HEAD
                Rule::unique('usuarios')->ignore($this->route('usuario'), 'id_usuario')
            ];
            
            // Contraseña opcional en actualizaciones
            $rules['password'] = 'nullable|string|min:6';
        } else {
            // Para creación (POST)
=======
                Rule::unique('usuarios', 'email')->ignore($usuarioId, 'id_usuario')
            ];

            $rules['password'] = 'nullable|string|min:6';
        } else {
>>>>>>> master
            $rules['email'] = 'required|email|max:255|unique:usuarios,email';
            $rules['password'] = 'required|string|min:6';
        }

        return $rules;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> master
