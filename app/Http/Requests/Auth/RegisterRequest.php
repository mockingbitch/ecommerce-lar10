<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|between:2,100',
            'email'             => 'required|string|email|max:100|unique:users',
            'phone'             => 'required|string|max:15',
            'password'          => 'required|string|min:6|max:20',
            'confirmPassword'   => 'same:password'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        return [
            'name.required'         => trans('validation.name_required'),
            'name.string'           => trans('validation.name_string'),
            'name.between'          => trans('validation.name_between'),
            'email.required'        => trans('validation.email_required'),
            'email.string'          => trans('validation.email_string'),
            'email.max'             => trans('validation.email_max'),
            'email.unique'          => trans('validation.email_unique'),
            'email.email'           => trans('validation.email_email'),
            'phone.required'        => trans('validation.phone_required'),
            'phone.string'          => trans('validation.phone_string'),
            'phone.max'             => trans('validation.phone_max'),
            'password.required'     => trans('validation.password_required'),
            'password.string'       => trans('validation.password_string'),
            'password.max'          => trans('validation.password_max'),
            'password.min'          => trans('validation.password_min'),
            'confirmPassword.same'  => trans('validation.confirm_password_same'),
        ];
    }
}
