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
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        // dd($action);
        switch ($action) {
            case 'store': {
                    return [
                        'category_id' => 'required|exists:categories,id',
                        'title' => 'required|string|max:255',
                        'description' => 'nullable|string',
                        'content' => 'required',
                        'author' => 'nullable',
                        'published_at' => 'required|date',
                        'type' => 'nullable',
                        'state' => 'required',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                }
            case 'update': {
                    return [
                        'category_id' => 'required|exists:categories,id',
                        'title' => 'required|string|max:255',
                        'description' => 'nullable|string',
                        'content' => 'required',
                        'author' => 'nullable',
                        'published_at' => 'required|date',
                        'type' => 'nullable',
                        'state' => 'required',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];
                }
            default:
                break;
        }
        return [];
    }

    public function messages()
    {
        return [
            'category_id.required' => "Vui lòng chọn danh mục ",
            'category_id.exists' => "Danh mục không tồn tại",
            'title.max' => "Tiêu đề không được vượt quá 255 ký tự",
            'title.required' => "Tiêu đề không được để trống",
            'content.required' => "Nội dung không được để trống",
            'published_at.required' => "Ngày xuất bản không được để trống",
            'published_at.date' => "Ngày xuất bản không đúng định dạng",
            'state.required' => "Trạng thái không được để trống",
            'image.image' => "Ảnh không đúng định dạng",
            'image.max' => "Ảnh không được vượt quá 2MB",
            'image.mimes' => "Ảnh phải có định dạng jpeg, jpg, png, gif hoặc svg",
            'title.string' => 'Tiêu đề phải là chuỗi',
            'description.string' => 'Mô tả phải là chuỗi',
            'content.string' => 'Nội dung phải là chuỗi',
            'author.string' => 'Tác giả phải là chuỗi',

        ];
    }
}
