<?php

namespace App\Http\Requests\Admin\Classroom;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role == User::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:classrooms,code,' . $this->classroom->id,
            'academic_year' => 'required|integer|digits:4',
            'semester' => 'required|string',
            'teacher_id' => 'required|integer|exists:users,id',
            'note' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'class name',
            'code' => 'class code',
            'teacher_id' => 'teacher'
        ];
    }
}
