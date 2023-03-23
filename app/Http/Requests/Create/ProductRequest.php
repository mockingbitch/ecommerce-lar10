<?php

namespace App\Http\Requests\Create;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          => 'required|max:100|string|unique:\App\Models\Product,name',
            'description'   => 'max:255|string',
            'detail'        => 'required',
            'price'         => 'required|digits_between:1,99999999999999|numeric',
            'quantity'      => 'required|digits_between:1,999999|numeric',
            'category_id'   => 'required|exists:App\Models\Category,id',
            'brand_id'      => 'required|exists:App\Models\Brand,id',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'name.required'             => trans('validation.required', ['attribute' => trans('product_name')]),
            'name.max'                  => trans('validation.max', ['attribute' => trans('product_name'), 'value' => '100']),
            'name.string'               => trans('validation.string', ['attribute' => trans('product_name')]),
            'name.unique'               => trans('validation.unique', ['attribute' => trans('product_name')]),
            'description.max'           => trans('validation.max', ['attribute' => trans('product_name'), 'value' => '255']),
            'description.string'        => trans('validation.string', ['attribute' => trans('product_name')]),
            'detail.required'           => trans('validation.required', ['attribute' => trans('product_name')]),
            'price.required'            => trans('validation.required', ['attribute' => trans('product_name')]),
            'price.digits_between'      => trans('validation.digits_between', ['attribute' => trans('product_name'), 'min' => '1', 'max' => '99999999999999']),
            'price.numeric'             => trans('validation.numeric', ['attribute' => trans('product_name')]),
            'quantity.required'         => trans('validation.required', ['attribute' => trans('product_name')]),
            'quantity.digits_between'   => trans('validation.digits', ['attribute' => trans('product_name'), 'min' => '1', 'max' => '999999']),
            'quantity.numeric'          => trans('validation.numeric', ['attribute' => trans('product_name')]),
            'category_id.required'      => trans('validation.required', ['attribute' => trans('product_name')]),
            'category_id.exists'        => trans('validation.exists', ['attribute' => trans('product_name')]),
            'brand_id.required'         => trans('validation.required', ['attribute' => trans('product_name')]),
            'brand_id.exists'           => trans('validation.exists', ['attribute' => trans('product_name')]),
            'image.image'               => trans('validation.image', ['attribute' => trans('product_name')]),
            'image.mimes'               => trans('validation.mimes', ['attribute' => trans('product_name')]),
            'image.max'                 => trans('validation.max', ['attribute' => trans('product_name'), 'value' => '2048']),
            'status.required'           => trans('validation.required', ['attribute' => trans('product_name')])
        ];
    }
}
