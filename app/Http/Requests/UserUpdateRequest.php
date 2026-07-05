<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest  extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'between:2,100', 'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9\-\_]+$/u', Rule::unique('users', 'name')->ignore(Auth::id())],
            'email' => ['required', 'email'],
            'introduction' => ['max:255'],
            'avatar' => ['mimes:png,gif,jpg,jpeg', 'dimensions:min_width=300,min_height=300'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'introduction' => '个人简介',
            'avatar' => '头像',
        ];
    }
}
