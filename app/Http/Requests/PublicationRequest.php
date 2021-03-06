<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'date_of_publication' => 'nullable',
            'authors' => 'required|array',
            'another_authors' => 'nullable|string',
            'publisher' => 'nullable|string',
            'url' => 'nullable|url'
        ];
    }
}
