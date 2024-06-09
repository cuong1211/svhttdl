<?php

namespace App\Http\Requests\Admin\Document;

use Illuminate\Foundation\Http\FormRequest;

class SignerDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:document_signers,name,' . $this->signer,
            'description' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('admin.field.unique'),
            'name.required' => trans('admin.field.required'),
        ];
    }
}
