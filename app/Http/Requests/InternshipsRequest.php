<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

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
        $rules = [];

        if(!Request::is('admin/profile/*'))
            $rules = ['user' => 'required|exists:users,id'];

        return array_merge($rules, [
            'category' => 'required|exists:internship_categories,id',
            'place' => 'required|exists:places,id',
            'title' => 'required|between:10,255',
            'from' => 'required',
            'to' => 'required',
            'code' => 'nullable',
            'hours' => 'required'
        ]);
    }
}
