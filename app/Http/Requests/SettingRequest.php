<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'app_name'    => 'required|max:100',
            'description' => 'required|max:100',
            'email'       => 'required|email',
            'phone'       => 'nullable|max:20',
            'logo'        => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
