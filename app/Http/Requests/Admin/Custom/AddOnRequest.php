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
                        'title' => 'required',
                        'order' => 'nullable',
                        'url' => 'required',
                        'image' => 'required',
                    
                    ];
                }
            case 'update': {
                    return [
                        'title' => 'required',
                        'order' => 'nullable',
                        'url' => 'required',
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
            'title.required' => 'Tiêu đề không được để trống',
            'order.required' => 'Thứ tự không được để trống',
            'url.required' => 'Đường dẫn không được để trống',
            'image.required' => 'Hình ảnh không được để trống',
        ];
    }
}
