<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:positions,name,' . $this->position,
            'description' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('admin.field.unique'),
            'name.required' => trans('admin.field.required'),
        ];
    }
}
