<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'mensaje' => 'required|string|min:5|max:255',
            'g-recaptcha-response' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'Por favor, ingrese su nombre.',
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email' => 'Por favor, ingrese un correo electrónico válido.',
            'mensaje.required' => 'Por favor, ingrese su mensaje.',
            'g-recaptcha-response.required' => 'Por favor, verifica que no seas un robot.',
        ];
    }
}
