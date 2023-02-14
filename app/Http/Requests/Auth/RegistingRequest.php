<?php

namespace App\Http\Requests\Auth;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistingRequest extends FormRequest
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
            'password'=> [
                'required',
                'string',
                'max:255',
                'min:5',
            ],
            'role'=>[
                'required',
                Rule::in([
                    UserRoleEnum::APPLICANT,
                    UserRoleEnum::HR,
                ]),

            ]
        ];
    }

    public function messages()
    {
        return[
            'password'=>[
                'required'=>'Mật khẩu không được để trống',
                'string'=>'Mật khẩu không được chứa kí tự đặc biệt',
                'max:255'=>'Mật khẩu quá dài',
                'min:5'=>"Mật khẩu có ít nhất 5 kí tự",
            ],
            'role'=>[
                'required'=>'Chưa chọn role',
                'in'=>'Role không hợp lệ',
            ],
        ];
    }
}
