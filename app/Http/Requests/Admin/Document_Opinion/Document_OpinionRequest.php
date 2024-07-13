<?php

namespace App\Http\Requests\Admin\Document_Opinion;

use Illuminate\Foundation\Http\FormRequest;

class Document_OpinionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'name' => 'required| max:255',
                        'content' => 'nullable',
                        'note' => 'nullable',
                        'document_file' => 'required|file|mimes:pdf',
                        'start_at' => 'required|date',
                        'end_at' => 'required|date',

                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required| max:255',
                        'content' => 'nullable',
                        'note' => 'nullable',
                        'document_file' => 'required|file|mimes:pdf',
                        'start_at' => 'required|date',
                        'end_at' => 'required|date',
                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên văn bản không được để trống',
            'name.max' => 'Tên văn bản không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'note.required' => 'Ghi chú không được để trống',
            'document_file.required' => 'Tập tin không được để trống',
            'document_file.file' => 'Tập tin không đúng định dạng',
            'document_file.mimes' => 'Tập tin phải là định dạng pdf',
            'document_file.max' => 'Tập tin không được vượt quá 2048 ký tự',
            'start_at.required' => 'Ngày bắt đầu không được để trống',
            'start_at.date' => 'Ngày bắt đầu không đúng định dạng',
            'end_at.required' => 'Ngày kết thúc không được để trống',
            'end_at.date' => 'Ngày kết thúc không đúng định dạng',

        ];
    }
}
