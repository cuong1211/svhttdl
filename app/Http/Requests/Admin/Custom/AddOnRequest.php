<?php

namespace App\Http\Requests\Admin\Custom;

use Illuminate\Foundation\Http\FormRequest;

class AddOnRequest extends FormRequest
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
                        'title' => 'required|max:255',
                        'order' => 'nullable|numeric',
                        'url' => 'nullable|max:255',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                        'state' => 'required|numeric',
                        'is_active' => 'required|numeric',
                        'user_id' => 'required|numeric',
                    ];
                }
            case 'update': {
                    return [
                        'title' => 'required|max:255',
                        'order' => 'nullable|numeric',
                        'url' => 'nullable|max:255',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                        'state' => 'required|numeric',
                        'is_active' => 'required|numeric',
                        'user_id' => 'required|numeric',
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
            'order.numeric' => 'Thứ tự phải là số',
            'order.required' => 'Thứ tự không được để trống',
            'url.required' => 'Đường dẫn không được để trống',
            'url.max' => 'Đường dẫn không được vượt quá 255 ký tự',
            'image.required' => 'Hình ảnh không được để trống',
            'image.image' => 'Hình ảnh không đúng định dạng',
            'image.mimes' => 'Hình ảnh phải là định dạng jpeg,png,jpg,gif,svg',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',

        ];
    }
}
