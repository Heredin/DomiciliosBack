<?php

namespace App\Http\Requests\Domicilio;

use Illuminate\Foundation\Http\FormRequest;

class DomicilioRequest extends FormRequest
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
    public function prepareForValidation()
    {
        $this->merge([
            'status' => $this->status ?? 'pending',
        ]);
    }
    public function rules(): array
    {
        return [
            'Municipio' => ['required',],
            'Colonia' => ['string', 'max:70'],
            'Domicilio' => ['string', 'max:150'],
            'NumExterior' => ['string', 'max:4'],
            'EntreCalles' => ['string', 'max:150'],
        ];
    }
}
