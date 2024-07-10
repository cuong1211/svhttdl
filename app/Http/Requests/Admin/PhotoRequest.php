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
            'content' => 'nullable|string',
            'image' => 'required|image|max:2048|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => 'Album không được để trống',
            'name.required' => 'Tên không được để trống',
            'image.required' => 'Ảnh không được để trống',
            'image.image' => "Ảnh không đúng định dạng",
            'image.max' => "Ảnh không được vượt quá 2MB",
            'image.mimes' => "Ảnh phải có định dạng jpeg, jpg, png hoặc gif",
            'name.max' => "Tên không được vượt quá 255 ký tự",
            'album_id.exists' => 'Album không tồn tại',
            'name.string' => 'Tên phải là chuỗi',
            'content.string' => 'Nội dung phải là chuỗi',
        ];
    }
}
