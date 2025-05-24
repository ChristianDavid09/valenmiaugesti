<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class signUpAdopter extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'surname' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'dni' => ['required', 'string', 'max:9', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{9,15}$/', 'unique:adopters,phone'],

            'age' => ['required', 'date'],
            'certificate' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'confirmed', Password::default()],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],

        ];
    }

    public function messages() {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 30 caracteres.',
            'surname.required' => 'El apellido es obligatorio.',
            'surname.string' => 'El apellido debe ser una cadena de texto.',
            'surname.max' => 'El apellido no puede tener más de 30 caracteres.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de 100 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.max' => 'El DNI no puede tener más de 9 caracteres.',
            'dni.unique' => 'El DNI ya está en uso.',
            'phone.regex' => 'El teléfono no es válido.',
            'phone.unique' => 'El teléfono ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'city.required' => 'La ciudad es obligatoria.',
            'city.max' => 'La ciudad no puede tener más de 100 caracteres.',
            'adress.required' => 'La dirección es obligatoria.',
            'adress.string' => 'La dirección debe ser una cadena de texto.',
            'adress.max' => 'La dirección no puede tener más de 255 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no puede tener más de 500 caracteres.',
            'certificate.mimes' => 'El certificado debe ser un archivo PDF.',
            'certificate.max' => 'El certificado no puede tener más de 2 MB.',
            'certificate.file' => 'El certificado debe ser un archivo.',
            'photo.image' => 'La foto debe ser una imagen.',
            'photo.mimes' => 'La foto debe ser un archivo de tipo jpeg, png o jpg.',
            'photo.max' => 'La foto no puede tener más de 2 MB.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}
