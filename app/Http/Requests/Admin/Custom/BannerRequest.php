<?php

namespace App\Http\Requests\Admin\Custom;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
    public function rules()
    {
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'title' => 'required|max:255',
                        'position' => 'required|max:255',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                        'is_active' => 'required|boolean'
                    
                    ];
                }
            case 'update': {
                    return [
                        'title' => 'required|max:255',
                        'position' => 'required|max:255',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|',
                        'is_active' => 'required|boolean'
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
            'position.required' => 'Vị trí không được để trống',
            'image.required' => 'Hình ảnh không được để trống',
            'is_active.required' => 'Trạng thái không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'position.max' => 'Vị trí không được vượt quá 255 ký tự',
            'image.image' => 'Hình ảnh không đúng định dạng',
            'image.mimes' => 'Hình ảnh phải là định dạng jpeg,png,jpg,gif,svg',
            'is_active.boolean' => 'Trạng thái phải là true hoặc false'
        ];
    }
}
