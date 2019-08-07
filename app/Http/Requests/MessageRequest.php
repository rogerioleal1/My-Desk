<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'company_id'  => 'required|exists:companies,id',
            'subject'     => 'required|max:100',
            'description' => 'required|min:10',
            'starts_from' => 'required',
            'expires_at'  => 'required',
            'status'      => 'max:1'
        ];
    }
}
