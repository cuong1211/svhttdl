<?php

namespace App\Http\Requests\Admin\Document_Opinion;

use Illuminate\Foundation\Http\FormRequest;

class OpinionRequest extends FormRequest
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
                        'name' => 'required | min:3 | max:255 ',
                        'email' => 'required|email | max:255 ',
                        'phone' => 'required | min:10 | max:11 ',
                        'address' => 'required | min:3 | max:255',
                        'title' => 'required | min:3',
                        'content' => 'required',

                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required | min:3 | max:255 ',
                        'email' => 'required|email | max:255 ',
                        'phone' => 'required | min:10 | max:11 ',
                        'address' => 'required | min:3 | max:255',
                        'title' => 'required | min:3',
                        'content' => 'required',

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
            'name.min' => 'Tên phải có ít nhất 3 ký tự',
            'name.max' => 'Tên không được quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được quá 255 ký tự',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự',
            'phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'address.required' => 'Địa chỉ không được để trống',
            'address.min' => 'Địa chỉ phải có ít nhất 3 ký tự',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
            'title.required' => 'Tiêu đề không được để trống',
            'title.min' => 'Tiêu đề phải có ít nhất 3 ký tự',
            'content.required' => 'Nội dung không được để trống',
        ];
    }
}
