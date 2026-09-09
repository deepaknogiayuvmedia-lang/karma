<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                 => 'required|array',
            'name.*'               => 'required|string|max:255',
            'category_id'          => 'required|integer|exists:categories,id',
            'product_type'         => 'required|in:physical,digital',
            'digital_product_type' => 'required_if:product_type,digital|nullable|in:ready_product,physical_product',
            'unit'                 => 'required_if:product_type,physical|nullable|string|max:50',
            'image'                => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tax'                  => 'required|numeric|min:0',
            'tax_model'            => 'required|in:include,exclude',
            'unit_price'           => 'required|numeric|gt:0',
            'purchase_price'       => 'required|numeric|gt:0',
            'discount'             => 'required|numeric|min:0',
            'shipping_cost'        => 'required_if:product_type,physical|nullable|numeric|min:0',
            'code'                 => 'required|numeric|min:1|digits_between:6,20|unique:products',
            'minimum_order_qty'    => 'required|numeric|min:1',
            'technical_name'       => 'nullable|array',
            'technical_name.*'     => 'nullable|string|max:255',
            'admin_commission'     => 'nullable|numeric|min:0',
            'admin_commission_type' => 'nullable|in:percentage,fixed',
            'priority'             => 'nullable|integer|min:0|max:5',
            'meta_title'           => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                => 'Product name is required!',
            'category_id.required'         => 'Category is required!',
            'category_id.exists'           => 'Invalid category selected!',
            'image.required'               => 'Product thumbnail is required!',
            'image.image'                  => 'Thumbnail must be an image!',
            'image.mimes'                  => 'Thumbnail must be jpg, jpeg, png, or webp!',
            'unit_price.required'          => 'Unit price is required!',
            'unit_price.gt'                => 'Unit price must be greater than 0!',
            'purchase_price.required'      => 'Purchase price is required!',
            'code.required'                => 'Product code is required!',
            'code.unique'                  => 'Product with this code already exists!',
            'code.digits_between'          => 'Code must be between 6 and 20 digits!',
            'minimum_order_qty.min'        => 'Minimum order quantity must be at least 1!',
            'admin_commission.numeric'     => 'Commission must be a number!',
            'admin_commission.min'         => 'Commission cannot be negative!',
            'admin_commission_type.in'     => 'Invalid commission type!',
            'priority.integer'             => 'Priority must be a number!',
            'priority.max'                 => 'Priority must be between 0 and 5!',
        ];
    }
}
