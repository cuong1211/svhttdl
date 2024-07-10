<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CooperationRequest extends FormRequest
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
            'link_website' => 'required|string|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => 'Album không được để trống',
            'name.required' => 'Tên không được để trống',
            'link_website.required' => 'Link website không được để trống',
            'image.required' => 'Ảnh không được để trống',
            'image.image' => "Ảnh không đúng định dạng",
            'image.max' => "Ảnh không được vượt quá 2MB",
            'image.mimes' => "Ảnh phải có định dạng jpeg, jpg, png hoặc gif",
            'name.max' => "Tên không được vượt quá 255 ký tự",
            'link_website.url' => 'Link website không đúng định dạng',
            'link_website.string' => 'Link website phải là chuỗi',
            'description.string' => 'Mô tả phải là chuỗi',
            'album_id.exists' => 'Album không tồn tại',
            'name.string' => 'Tên phải là chuỗi',
        ];
    }
}
