<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class signUpCologne extends FormRequest
{
    /**
     * Metodo para determinar si el usuario está autorizado a realizar esta solicitud.
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
            //Validación del nombre, email y teléfono del usuario
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            /* 'dni' => ['required', 'string', 'max:9', 'unique:users'], */
            /**Comprobamos el número telefónico como una string y no como un int, los motivos son:
             * -Si algun usuario quiere incluir un + delante del numero, un tipo int no lo aceptara.
             * -Al no usarse como operaciones matematicas no es necesario que sea un int.
             * -Si algun numero contiene algun cero inicial, al ser un int lo eliminaría.
             * -Si el número de teléfono es muy largo, un int no lo aceptará.
             */
            'phone' => ['string', 'regex:/^\+?[0-9]{9,15}$/'],

            //Validación de los datos de la colonia
            'colonia_name' => ['required', 'string', 'max:100', 'unique:colognes,name'],
            /* 'id_ref_com' => ['required', 'string', 'max:50', 'unique:colognes'], */
            'colonia_location' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],

            'password' => ['required', 'confirmed', Password::default()],
        ];
    }

    public function messages()
    {
        //Reglas a seguir para cada uno de los campos del formulario con sus respectivas validaciones
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 30 caracteres.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de 100 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'phone.regex' => 'El teléfono no es válido.',
            'phone.max' => 'El teléfono no puede tener más de 15 caracteres.',
            /* 'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.max' => 'El DNI no puede tener más de 9 caracteres.',
            'dni.unique' => 'El DNI ya está en uso.', */
            'colonia_name.required' => 'El nombre de la colonia es obligatorio.',
            'colonia_name.string' => 'El nombre de la colonia debe ser una cadena de texto.',
            'colonia_name.max' => 'El nombre de la colonia no puede tener más de 100 caracteres.',
            'colonia_name.unique' => 'El nombre de la colonia ya está en uso.',
            /* 'id_ref_com.string' => 'El ID de referencia de la comunidad debe ser una cadena de texto.',
            'id_ref_com.unique' => 'El ID de referencia de la comunidad ya está en uso.',
            'id_ref_com.required' => 'El ID de referencia de la comunidad es obligatorio.', */
            'colonia_location.required' => 'La ubicación de la colonia es obligatoria.',
            'colonia_location.string' => 'La ubicación de la colonia debe ser una cadena de texto.',
            'colonia_location.max' => 'La ubicación de la colonia no puede tener más de 255 caracteres.',
            'city.string' => 'La ciudad debe ser una cadena de texto.',
            'city.max' => 'La ciudad no puede tener más de 100 caracteres.',
            'city.required' => 'La ciudad es obligatoria.',
            'photo.image' => 'La foto debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser un archivo de tipo jpeg, png o jpg.',
            'photo.max' => 'La foto no puede tener más de 2 MB.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
