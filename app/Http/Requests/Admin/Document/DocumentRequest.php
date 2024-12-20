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
                        'content' => 'nullable|string',
                        'reference_number' => 'required|string|max:255',
                        'notes' => 'nullable|string',
                        'published_at' => 'required|date',
                        'tag_id' => 'required|exists:document_signers,id',
                        'type_id' => 'required|exists:document_types,id',
                        'singer' => 'nullable|string|max:255',
                        'document_file' => 'required|file|mimes:pdf',
                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required|string|max:255',
                        'content' => 'nullable|string',
                        'reference_number' => 'required|string|max:255',
                        'notes' => 'nullable|string',
                        'published_at' => 'required|date',
                        'tag_id' => 'required|exists:document_signers,id',
                        'type_id' => 'required|exists:document_types,id',
                        'singer' => 'nullable|string|max:255',
                        'document_file' => 'nullable|file|mimes:pdf',
                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => "Tên không được để trống",
            'document_types.required' => "Loại văn bản không được để trống",
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
            'document_file.required' => "File không được để trống",
            'document_file.mimes' => "File phải có định dạng pdf",
        ];
    }
}
