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
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'password' => 'nullable|confirmed|min:8',
            'avatar' => 'nullable|image',
            'department' => 'nullable|exists:departments,id',
            'commission' => 'nullable|exists:commissions,id',
            'birthday' => 'nullable|date',
            'passport' => 'nullable',
            'code' => 'nullable',
            'rank' => 'nullable|exists:ranks,id'
        ];
    }
}
