<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'album_id' => 'required|exists:albums,id',
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => trans('admin.field.required'),
            'name.required' => trans('admin.field.required'),
            'content.required' => trans('admin.field.required'),
            'image.required' => trans('admin.field.required'),
        ];
    }
}
