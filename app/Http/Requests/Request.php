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

}
