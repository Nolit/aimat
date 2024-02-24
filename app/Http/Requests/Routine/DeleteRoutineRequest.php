<?php

namespace App\Http\Requests\Routine;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRoutineRequest extends FormRequest
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
