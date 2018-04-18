<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('post')->id;
        return [
            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),
            ],
            'body' => 'required',
        ];
    }
}
