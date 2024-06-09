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
                Rule::unique('categories')->ignore($this->category->id ?? null),
            ],
            'order' => 'nullable',
            'in_menu' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id',
            'title_en' => 'nullable|string|min:3|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => trans('admin.field.unique'),
            'title.required' => trans('admin.field.required'),
        ];
    }
}
