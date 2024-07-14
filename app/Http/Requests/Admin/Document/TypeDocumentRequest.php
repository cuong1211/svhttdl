<?php

namespace App\Http\Requests\Admin\Document;

use Illuminate\Foundation\Http\FormRequest;

class TypeDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:document_types,title',
            'description' => 'nullable|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên loại tài liệu không được để trống',
            'name.unique' => 'Tên loại tài liệu đã tồn tại',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự',

        ];
    }
}
