<?php

namespace App\Http\Requests\Create;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'          => 'required|max:50|min:2|string|unique:\App\Models\Category,name',
            'description'   => 'max:255|string|nullable',
            'status'        => 'required'
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
            'name.required'         => trans('validation.required', ['attribute' => trans('category_name')]),
            'name.max'              => trans('validation.max', ['attribute' => trans('category_name'), 'value' => '50']),
            'name.string'           => trans('validation.string', ['attribute' => trans('category_name')]),
            'name.unique'           => trans('validation.unique', ['attribute' => trans('category_name')]),
            'name.min'              => trans('validation.min', ['attribute' => trans('category_name'), 'value' => '1']),
            'description.max'       => trans('validation.max', ['attribute' => trans('category_description'), 'value' => '255']),
            'description.string'    => trans('validation.string', ['attribute' => trans('category_description')]),
            'status.required'       => trans('validation.required', ['attribute' => trans('status')])
        ];
    }
}
