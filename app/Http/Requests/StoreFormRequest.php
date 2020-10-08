<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'page_uid' => 'required|string|min:12|unique:forms,page_uid',
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:10'
        ];
    }
}
