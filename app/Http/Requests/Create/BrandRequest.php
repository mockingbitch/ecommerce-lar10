<?php

namespace App\Http\Requests\Create;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name'          => 'required|max:50|string',
            'description'   => 'max:255|string',
            'status'        => 'in:[0, 1]'
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
            'name.required'         => trans('validation.required', ['attribute' => trans('brand_name')]),
            'name.max'              => trans('validation.max', ['attribute' => trans('brand_name'), 'value' => '50']),
            'name.string'           => trans('validation.string', ['attribute' => trans('brand_name')]),
            'description.max'       => trans('validation.max', ['attribute' => trans('brand_description'), 'value' => '255']),
            'description.string'    => trans('validation.string', ['attribute' => trans('brand_description')]),
            'status.in'             => trans('validation.in', ['attribute' => trans('status')])
        ];
    }
}
