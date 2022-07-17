<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceByCoinRequest extends FormRequest
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
            'coin' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'coin.required' => 'Coin is required (DACXI, ETH, ATOM, LUNA, BITCOIN).',
        ];
    }
}
