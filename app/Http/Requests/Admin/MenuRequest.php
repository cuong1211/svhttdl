<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                        'title_en' => 'nullable|max:255',
                        'user_id' => 'nullable|integer',
                        'in_menu' => 'required|boolean',
                        'parent_id' => 'nullable|integer',
                        'link' => 'nullable|max:255',
                        'order' => 'nullable|integer',

                    ];
                }
            case 'update': {
                    return [
                        'title' => 'required|max:255',
                        'title_en' => 'nullable|max:255',
                        'user_id' => 'nullable|integer',
                        'in_menu' => 'required|boolean',
                        'parent_id' => 'nullable|integer',
                        'link' => 'nullable|max:255',
                        'order' => 'nullable|integer',

                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên không được để trống',
            'title.max' => 'Tên không được vượt quá 255 ký tự',
            'title_en.max' => 'Tên không được vượt quá 255 ký tự',
            'user_id.integer' => 'User ID phải là số',
            'in_menu.required' => 'Trường này không được để trống',
            'in_menu.boolean' => 'Trường này phải là boolean',
            'parent_id.integer' => 'Parent ID phải là số',
            'link.max' => 'Link không được vượt quá 255 ký tự',
            'order.integer' => 'Order phải là số',
        ];
    }
}
