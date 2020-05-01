<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class EducationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        if(!Request::is('admin/profile/*'))
            $rules = ['user' => 'required|exists:users,id'];

        return array_merge($rules, [
            'institution' => 'required|string|min:5',
            'qualification' => 'required|string',
            'graduate_year' => 'required|integer'
        ]);
    }
}
