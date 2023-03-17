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
            'password'          => 'required|string|min:6',
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
            // 'name.required' => trans('name_required'),
            // 'confirmPassword.same' => trans('')
        ];
    }
}