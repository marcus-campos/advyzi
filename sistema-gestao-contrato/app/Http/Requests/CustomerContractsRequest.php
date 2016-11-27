<?php

namespace SgcAdmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerContractsRequest extends FormRequest
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
            'nif' => 'unique:customer_contracts',
            'email' => 'email|unique:customer_contracts'
        ];
    }
}
