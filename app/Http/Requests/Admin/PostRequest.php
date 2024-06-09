<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'content' => 'required',
            'published_at' => 'required|date', // Ensure this is a valid date
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => trans('admin.field.required'),
            'category_id.exists' => trans('admin.field.invalid_category'), // Custom message for non-existing category
            'title.unique' => trans('admin.field.unique'),
            'title.required' => trans('admin.field.required'),
            'content.required' => trans('admin.field.required'),
            'published_at.required' => trans('admin.field.required'),
            'published_at.date' => trans('admin.field.invalid_date'), // Custom message for invalid date
        ];
    }
}
