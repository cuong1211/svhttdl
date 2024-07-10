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
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'name' => 'required|string|max:255',
                        'description' => 'nullable|string',

                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required|string|max:255',
                        'description' => 'nullable|string',
                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự'

        ];
    }
}
