<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                // Rule::unique('categories')->ignore($this->category->id ?? null),
            ],
            'order' => 'nullable|numeric',
            'in_menu' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id',
            'title_en' => 'nullable|string|min:3|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => "Tiêu đề đã tồn tại",
            'title.required' => "Tiêu đề không được để trống",
            'title.max' => "Tiêu đề không được vượt quá 255 ký tự",
            'title_en.min' => "Tiêu đề tiếng Anh phải có ít nhất 3 ký tự",
            'title_en.max' => "Tiêu đề tiếng Anh không được vượt quá 255 ký tự",
            'user_id.required' => "Người dùng không được để trống",
            'user_id.exists' => "Người dùng không tồn tại",
            'parent_id.exists' => "Danh mục cha không tồn tại",
            'in_menu.required' => "Trường này không được để trống",
            'in_menu.boolean' => "Trường này phải là boolean",
            'order.numeric' => "Trường này phải là số",
        ];
    }
}
