<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnnouncementRequest extends FormRequest
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
                        'title' => 'required|max:255|unique:announcements',
                        'content' => 'required|string',

                    ];
                }
            case 'update': {
                    return [
                        'title' => [
                            'required',
                            'max:255',
                            Rule::unique('announcements')->ignore($this->announcement->id)
                        ],
                        'content' => 'required|string',

                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'content.required' => 'Nội dung không được để trống',
        ];
    }
}
