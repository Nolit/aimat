<?php

namespace App\Http\Requests\Path;

use Illuminate\Foundation\Http\FormRequest;

class DeletePathRequest extends FormRequest
{
    public function rules(): array
    {

        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
