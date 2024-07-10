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
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'name' => 'required|string|max:255',
                        'content' => 'required|string',
                        'reference_number' => 'required|string|max:255',
                        'note' => 'nullable|string',
                        'tag_id' => 'required|exists:document_signers,id',
                        'type_id' => 'required|exists:document_types,id',
                        'singer' => 'nullable|string|max:255',

                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required|string|max:255',
                        'content' => 'required|string',
                        'reference_number' => 'required|string|max:255',
                        'note' => 'nullable|string',
                        'tag_id' => 'required|exists:document_signers,id',
                        'type_id' => 'required|exists:document_types,id',
                        'singer' => 'nullable|string|max:255',
                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.field.required.name'),
            'content.required' => trans('admin.field.required.content'),
            'image.required' => trans('admin.field.required.image'),
            'document_types.required' => trans('admin.field.required.document_types'),
            'signers_id.required' => trans('admin.field.required.signers_id'),
            'name.max' => "Tên không được vượt quá 255 ký tự",
            'content.max' => "Nội dung không được vượt quá 255 ký tự",
            'reference_number.required' => "Số văn bản không được để trống",
            'reference_number.max' => "Số văn bản không được vượt quá 255 ký tự",
            'note.max' => "Ghi chú không được vượt quá 255 ký tự",
            'tag_id.required' => "Thể loại không được để trống",
            'tag_id.exists' => "Thể loại không tồn tại",
            'type_id.required' => "Loại văn bản không được để trống",
            'type_id.exists' => "Loại văn bản không tồn tại",
            'singer.max' => "Tên người ký không được vượt quá 255 ký tự",

        ];
    }
}
