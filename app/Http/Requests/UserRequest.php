<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        // create rules
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'department' => 'nullable|exists:departments,id',
            'commission' => 'nullable|exists:commissions,id'
        ];

        // edit
        if($this->getMethod() == 'PUT'){
            //get user that edit
            $user = Request::route()->parameter('user');

            $rules = array_merge($rules, [
                'hiring_year' => 'nullable|integer',
                'pedagogical_title' => [
                    'nullable',
                    'string',
                    Rule::in(User::getPedagogicalTitles())
                ],
                'experience' => 'nullable|integer',
                'address' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($user->id)
                ],
                'birthday' => 'nullable|date',
                'passport' => [
                    'nullable',
                    Rule::unique('users','passport')->ignore($user->id)
                ],
                'code' => [
                    'nullable',
                    Rule::unique('users','code')->ignore($user->id)
                ],
                'role' => [
                    'required',
                    'numeric',
                    Rule::in(array_keys(User::getRolesArray()))
                ],
                'password' => 'nullable|confirmed|min:8',
                'rank' => 'nullable|exists:ranks,id'
            ]);
        }

        return $rules;
    }
}
