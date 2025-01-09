<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'producto_id' => 'required|integer|exists:productos,id',
            'modelo' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'qty' => 'required|integer|min:1',
            'talla' => 'required|string|regex:/^[A-Za-z0-9]+$/|exists:tallas,talla',
            'url_imagen' => 'required|string',
        ];
    }
}
