<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name'       => 'required|max:100',
            'email'      => 'required|email|max:100|unique:users',
            'company_id' => 'required|exists:companies,id',
            'group_id'   => 'required|exists:groups,id',
            'password'   => 'required|min:8|confirmed',
            'avatar'     => 'image|mimes:jpg,jpeg,png|max:2048',
            'status'     => 'max:1'
        ];
    }
}