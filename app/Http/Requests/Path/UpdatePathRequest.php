<?php

namespace App\Http\Requests\Path;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePathRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
