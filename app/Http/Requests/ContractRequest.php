<?php

namespace SgcAdmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'which_hired' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'operator_id' => 'required'
        ];
    }
}
