<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Feline;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FormFeline extends FormRequest
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
            'name' => ['required','string','max:100'],
            'age' => ['nullable','integer','min:0','max:50'],
            'race' => ['required','string','max:100'],
            'sex' => ['required','in:Macho,Hembra'],
            'health_status' => ['required','string'],
            'sterilized' => ['required'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg','max:2048']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre del felino es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 100 caracteres.',

            'age.integer' => 'La edad debe ser un número.',
            'age.min' => 'La edad no puede ser negativa.',
            'age.max' => 'La edad no puede superar los 50 años.',

            'race.required' => 'La raza es obligatoria.',
            'race.string' => 'La raza debe ser una cadena de texto.',
            'race.max' => 'La raza no puede tener más de 100 caracteres.',

            'sex.required' => 'El sexo del felino es obligatorio.',
            'sex.in' => 'El sexo debe ser "Macho" o "Hembra".',

            'health_status.required' => 'El estado de salud es obligatorio.',

            'sterilized.required' => 'Debes indicar si el felino está esterilizado.',

            'image.image' => 'El archivo debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o webp.',
            'image.max' => 'La imagen no debe tener más de 2 MB.',
        ];
    }

}
