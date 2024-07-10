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
                        'name' => 'required|max:255',
                        'type' => 'required|max:255',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',

                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required|max:255',
                        'type' => 'required|max:255',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',

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
            'name.max' => 'Tên album không được vượt quá 255 ký tự',
            'type.max' => 'Loại album không được vượt quá 255 ký tự',
            'image.image' => 'Hình ảnh không đúng định dạng',
            'image.mimes' => 'Hình ảnh phải là định dạng jpeg,png,jpg,gif,svg',
            
        ];
    }
}
