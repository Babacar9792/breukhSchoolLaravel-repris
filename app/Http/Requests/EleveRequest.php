<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EleveRequest extends FormRequest
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
            //
            "prenom" => "required|regex:/^[a-zA-Z]+$/",
            "nom" => "required|regex:/^[a-zA-Z]+$/",
            "date_naissance" =>  "bail|required|date|before:today- 5years",
        ];
    }

    public function messages()
    {
        return [

            "prenom.regex" => "Le prenom ne doit contenir que des lettres",
            "nom.regex" => "Le nom ne doit contenir que des lettres",
            "date_naissance.date" => "la date de naissance doit avoir un format de date Y-M-J",
            "date_naissance.before" => "Tous les élèves doivent être agés de 5 ans au moins "
        ];
    }


    protected function errorValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()));
    }
}
