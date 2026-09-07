<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class editUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Validación de los datos del formulario de registro
        return [
            //Validación del nombre, email, dni y contraseña del usuario
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:100'],
            /* 'dni' => ['required', 'string', 'min:9','max:9'], */
            'password' => ['nullable','confirmed', Password::default()],
        ];
    }

    public function messages() {
        //Reglas a seguir para cada uno de los campos del formulario con sus respectivas validaciones
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 30 caracteres.',
            /* 'dni.required' => 'El DNI es obligatorio.',
            'dni.max' => 'El DNI no puede tener más de 9 caracteres.',
            'dni.min' => 'El DNI no puede tener menos de 9 caracteres.',
            'dni.unique' => 'El DNI ya está en uso.', */
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de 100 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
        ];
    }
}
