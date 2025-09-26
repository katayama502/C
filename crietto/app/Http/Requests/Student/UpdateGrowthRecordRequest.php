<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGrowthRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isStudent();
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'mood' => ['nullable', 'string', 'max:255'],
            'learning_time' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
