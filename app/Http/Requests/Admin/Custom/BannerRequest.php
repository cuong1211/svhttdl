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
                        'title' => 'required',
                        'position' => 'required',
                        'image' => 'required',
                        'is_active' => 'required'
                    
                    ];
                }
            case 'update': {
                    return [
                        'title' => 'required',
                        'position' => 'required',
                        'image' => 'nullable',
                        'is_active' => 'required'
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
        ];
    }
}
