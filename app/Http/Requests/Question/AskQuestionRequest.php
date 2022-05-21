<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
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
            'title' => 'required|unique:questions|max:255',
            'body' => 'required|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'The question field is required'
        ];
    }
}
