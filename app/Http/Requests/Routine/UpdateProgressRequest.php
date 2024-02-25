<?php

namespace App\Http\Requests\Routine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
