<?php

namespace App\Http\Requests\Admin\Grade;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'teacher_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
            'grade' => 'required|numeric',
            'lesson_name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'student_id' => 'student',
            'teacher_id' => 'teacher'
        ];
    }
}
