<?php

namespace App\Http\Requests\Routine;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoutineRequest extends FormRequest
{
    public function rules(): array
    {
        return [
//            'title' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
