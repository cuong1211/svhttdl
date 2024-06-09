<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'video_id' => 'required|string',
            'source' => 'required|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => trans('admin.field.required'),
            'name.required' => trans('admin.field.required'),
            'video_id.required' => trans('admin.field.required'),
            'source.required' => trans('admin.field.required'),
        ];
    }
}
