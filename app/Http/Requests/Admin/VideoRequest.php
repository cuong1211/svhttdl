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
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => 'Album không được để trống',
            'name.required' => 'Tên không được để trống',
            'video_id.required' => 'ID video không được để trống',
            'source.required' => 'Nguồn không được để trống',
            'album_id.exists' => 'Album không tồn tại',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'source.max' => 'Nguồn không được vượt quá 2048 ký tự',
            'is_active.boolean' => 'Trạng thái phải là boolean',
        ];
    }
}
