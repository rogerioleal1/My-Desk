<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'type'        => 'required|numeric|between:1,2',
            'category_id' => 'required|exists:categories,id',
            'system_id'   => 'required|exists:systems,id',
            'priority'    => 'required|numeric|between:1,5',
            'subject'     => 'required|max:100',
            'description' => 'required|min:10',
            'status'      => 'numeric|between:1,5',
            'solution'    => 'nullable|min:10',
        ];
    }
}
