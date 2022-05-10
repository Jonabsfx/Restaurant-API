<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_id' => 'required',
            'table_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Informe o Cliente',
            'table_id.required' => 'Informe a Mesa',
        ];
        
    }
}
