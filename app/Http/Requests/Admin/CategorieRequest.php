<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:departments|max:255',
            'description' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('admin.field.unique'),
            'name.required' => trans('admin.field.required'),
            'name.max' => "Tên không được vượt quá 255 ký tự"
        ];
    }
}
