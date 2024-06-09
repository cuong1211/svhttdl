<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|unique:announcements,title',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => trans('admin.field.unique'),
            'title.required' => trans('admin.field.required'),
            'content.required' => trans('admin.field.required'),
        ];
    }
}
