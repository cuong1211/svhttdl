<?php

namespace App\Http\Requests\Admin\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'type_id' => 'required|exists:document_types,id',
            'signer_id' => 'required|exists:document_signers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.field.required.name'),
            'content.required' => trans('admin.field.required.content'),
            'image.required' => trans('admin.field.required.image'),
            'document_types.required' => trans('admin.field.required.document_types'),
            'signers_id.required' => trans('admin.field.required.signers_id'),
        ];
    }
}
