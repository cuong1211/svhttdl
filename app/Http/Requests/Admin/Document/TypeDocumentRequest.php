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
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('admin.field.unique'),
            'name.required' => trans('admin.field.required'),
            'description.required' => trans('admin.field.required'),
        ];
    }
}
