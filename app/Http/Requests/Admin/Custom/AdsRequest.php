<?php

namespace App\Http\Requests\Admin\Custom;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
                        'url' => 'required|max:255|url',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                    
                    ];
                }
            case 'update': {
                    return [
                        'title' => 'required|max:255',
                        'order' => 'nullable|numeric',
                        'url' => 'required|max:255|url',
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
            'title.required' => 'Tiêu đề không được để trống',
            'order.required' => 'Thứ tự không được để trống',
            'url.required' => 'Đường dẫn không được để trống',
            'image.required' => 'Hình ảnh không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'order.numeric' => 'Thứ tự phải là số',
            'url.max' => 'Đường dẫn không được vượt quá 255 ký tự',
            'image.image' => 'Hình ảnh không đúng định dạng',
            'image.mimes' => 'Hình ảnh phải là định dạng jpeg,png,jpg,gif,svg',
            'url.url' => 'Đường dẫn không đúng định dạng',

        ];
    }
}
