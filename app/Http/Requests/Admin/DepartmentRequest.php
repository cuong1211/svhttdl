<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Tên đã tồn tại',
            'name.required' => 'Tên không được để trống',
            'name.max' => "Tên không được vượt quá 255 ký tự",
            'type.required' => 'Loại không được để trống',
            'type.string' => 'Loại phải là chuỗi',
            'type.max' => 'Loại không được vượt quá 255 ký tự',
            'description.string' => 'Mô tả phải là chuỗi',
        ];
    }
}
