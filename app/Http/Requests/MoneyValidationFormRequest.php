<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoneyValidationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //define regra que o campo será obrigatório e numérico
            //esta regra será usada no BalanceController
            'value' => 'required|numeric',
        ];
    }
}
