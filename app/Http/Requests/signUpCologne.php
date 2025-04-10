<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class signUpCologne extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'required|string|max:20',
    
            'colonia_name' => 'required|string|max:100',
            'id_ref_com' => 'required|string|max:50|unique:colonias,id_ref_com',
            'colonia_location' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
    
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'phone.required' => 'El teléfono es obligatorio.',
            'colonia_name.required' => 'El nombre de la colonia es obligatorio.',
            'id_ref_com.required' => 'El ID de referencia de la comunidad es obligatorio.',
            'colonia_location.required' => 'La ubicación de la colonia es obligatoria.',
            'city.required' => 'La ciudad es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}
