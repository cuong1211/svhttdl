<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:positions,name,' . $this->position,
            'description' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Tên đã tồn tại',
            'name.required' => 'Tên không được để trống',
            'name.max' => "Tên không được vượt quá 255 ký tự",
            'description.string' => 'Mô tả phải là chuỗi',
            'name.string' => 'Tên phải là chuỗi',
        ];
    }
}
