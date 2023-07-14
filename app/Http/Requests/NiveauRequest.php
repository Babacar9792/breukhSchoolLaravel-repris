<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NiveauRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "libelle" => "required"
            //
        ];
    }

    public function messages()
    {
        return [
            "libelle.required" => "Veuiller entrer le nom du niveau que vous souhaiter ajouter"
        ];
    }
    protected function errorValidation(Validator $validator)
    {
            throw new HttpResponseException(response()->json($validator->errors())); 
    }
}
