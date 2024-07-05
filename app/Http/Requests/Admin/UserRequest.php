<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $input = $this->all();
        $input['password'] = trim($input['password']);
        $this->replace($input);

        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'name' => 'required|regex: /^[ a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/|max:255|min:2',
                        // 'name'=>['required','alpha','max:255','min:2'],
                        'email' => 'required|max:255|email|unique:users|regex:/^[A-Za-z0-9.@+]*$/|email:rfc,dns',
                        'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                        'address' => 'nullable|max:255',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'state' => 'required|boolean',
                        'provide_id' => 'nullable|integer',
                        'department_id' => 'required| not in:0',
                        'category_id' => 'required| not in:0',
                        'display_name' => 'required|max:255',
                        'password' => 'required|min:8|max:255|confirmed',
                        'password_confirmation' => 'required|min:8'
                    ];
                }
            case 'update': {
                    return [
                        'name' => 'required|regex: /^[ a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/|max:255|min:2',
                        // 'name'=>['required','max:255','min:2','alpha'],
                        'email' => 'required|max:255|email|regex:/^[A-Za-z0-9.@+]*$/|email:rfc,dns|unique:users,email,' . $this->user,
                        'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                        'address' => 'nullable|max:255',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'state' => 'required|boolean',
                        'provide_id' => 'nullable|integer',
                        'department_id' => 'required| not in:0',
                        'category_id' => 'required| not in:0',
                        'display_name' => 'required|max:255',
                        'password' => 'required|min:8|max:255',
                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên tài khoản không được để trống',
            'name.regex' => 'Tên tài khoản không hợp lệ',
            'name.max' => 'Tên tài khoản không được quá 255 ký tự',
            'name.min' => 'Tên tài khoản không được dưới 2 ký tự',
            'email.required' => 'Email không được để trống',
            'email.max' => 'Email không được quá 255 ký tự',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'email.regex' => 'Email không hợp lệ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại không được dưới 10 ký tự',
            'phone.max' => 'Số điện thoại không được quá 15 ký tự',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
            'image.image' => 'Ảnh không hợp lệ',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg',
            'image.max' => 'Ảnh không được quá 2048 ký tự',
            'state.required' => 'Trạng thái không được để trống',
            'state.boolean' => 'Trạng thái không hợp lệ',
            'provide_id.integer' => 'Xã không hợp lệ',
            'department_id.required' => 'Phòng ban không được để trống',
            'display_name.required' => 'Tên hiển thị không được để trống',
            'display_name.max' => 'Tên hiển thị không được quá 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không được dưới 8 ký tự',
            'password.max' => 'Mật khẩu không được quá 255 ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'password_confirmation.min' => 'Mật khẩu xác nhận không được dưới 8 ký tự',
            'category_id.required' => 'Loại tài khoản không được để trống',
            'department_id.not_in' => 'Cần chọn phòng ban',
            'category_id.not_in' => 'Cần chọn loại tài khoản',
        ];
    }
}
