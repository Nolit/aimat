<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTaskRequest extends FormRequest
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
