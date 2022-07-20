<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PriceAndDatetimeRequest extends FormRequest
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
            'coin' => 'required|string|max:255',
            'datetime' => 'required|date_format:Y-m-d H:i'
        ];
    }

    public function messages()
    {
        return [
            'coin.required' => 'Coin is required (DACXI, ETH, ATOM, LUNA, BITCOIN).',
            'datetime.required' => 'DateTime is required, Format(YYYY-MM-DD HH:II)',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],400));
    }
}
