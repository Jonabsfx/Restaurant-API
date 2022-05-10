<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'value' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do item é obrigatório',
            'value.required' => 'Você deve preencher o valor do item',
            'value.numeric' => "O valor do item deve ser um número",
        ];
        
    }
}
