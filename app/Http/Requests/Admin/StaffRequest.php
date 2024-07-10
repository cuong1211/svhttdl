<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'content.string' => 'Nội dung phải là chuỗi',
            'department_id.required' => 'Phòng ban không được để trống',
            'department_id.exists' => 'Phòng ban không tồn tại',
            'position_id.required' => 'Chức vụ không được để trống',
            'position_id.exists' => 'Chức vụ không tồn tại',
        ];
    }
}
