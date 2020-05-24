<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !!Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'nullable|confirmed|min:8',
            'avatar' => 'nullable|image',
            'birthday' => 'nullable|date',
            'passport' => 'nullable',
            'code' => 'nullable',
            'phone' => 'nullable|string|max:13|min:10',
            'address' => 'nullable|string|max:255'
        ];
    }
}
