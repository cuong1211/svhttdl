<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
                        'name' => 'required',
                        'type' => 'required',
                        'image' => 'required',

                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required',
                        'type' => 'required',
                        'image' => 'nullable',

                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên album không được để trống',
            'type.required' => 'Loại album không được để trống',
            'image.required' => 'Hình ảnh không được để trống',
        ];
    }
}
