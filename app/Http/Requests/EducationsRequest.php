<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user' => 'required|exists:users,id',
            'institution' => 'required|string|min:5',
            'qualification' => 'required|string',
            'graduate_year' => 'required|integer'
        ];
    }
}
