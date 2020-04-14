<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class InternshipsRequest extends FormRequest
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
            'category' => 'required|exists:internship_categories,id',
            'place' => 'required|exists:places,id',
            'title' => 'required|between:10,255',
            'from' => 'required',
            'to' => 'required',
            'code' => 'nullable',
            'hours' => 'required'
        ];
    }
}
