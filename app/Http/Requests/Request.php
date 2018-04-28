<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function response(array $errors)
    {
        return back()->withErrors($errors)->withInput();
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            '*.required'        => 'The :attribute field is required',
            '*.unique'          => 'The :attribute field needs to be unique',
            '*.are_valid_rules' => 'Must be pipe separated set of Laravel validation rules',
        ];
    }
}
