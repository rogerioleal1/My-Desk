<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'      => 'required|email|unique:users,email,' . $this->segment(2),
            'company_id' => 'required|exists:companies,id',
            'group_id'   => 'required|exists:groups,id',
            'password'   => 'nullable|min:8|confirmed',
            'avatar'     => 'image|mimes:jpg,jpeg,png|max:2048',
            'status'     => 'max:1'
        ];
    }
}
